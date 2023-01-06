<?php

use App\Utils\ProductCsvMapping;
use App\Utils\BaseConstants;

class vendor extends controller
{
    use \App\Core\BaseTrait;

    const PRODUCT_DETAILS = "productdetails";

    /** @var vendormodel $vendorModel */
    private $vendorModel;


    public function __construct()
    {
        $this->vendorModel = $this->load_model("vendormodel");
    }

    public function index(){

        $data['page_title']="Home";

        $this->view("samrons/admin/dashboard",$data);

    }

    public function addProducts(){
        $data['options'] = $this->getOptions();
        $data['categories'] = $this->getCategories();

        $this->view("samrons/admin/addProducts",$data);

    }

    public function getsubcategories()
    {
        if (!empty($_POST["source"]) && $_POST["source"] == "script") {
            print_r($this->vendorModel->get_categories($_POST['parentid']));
        } else {
            $data['categories'] = $this->vendorModel->get_categories($_POST['parentid']);
            return $data;
        }
    }

    public function getoptionValues()
    {
        if (!empty($_POST["source"]) && $_POST["source"] == "script") {
            print_r($this->vendorModel->get_optionvalues($_POST['optionid']));
        } else {
            $data['optionvalues'] = $this->vendorModel->get_optionvalues($_POST['optionid']);
            return json_encode($data, true);
        }
    }

    public function viewProducts($productId = "") {
        $data['page_title']="Home";
        $data['productData'] = $this->vendorModel->get_productDetails($productId);
        $this->view("samrons/admin/dashboard",$data);

    }
    public function addProductDetails()
    {
        $this->validateFieldExists([
            BaseConstants::NAME,
            BaseConstants::DESCRIPTION,
            BaseConstants::MRP,
            BaseConstants::SELLER_PRICE,
            BaseConstants::GST,
            BaseConstants::BRAND,
            BaseConstants::WEIGHT,
            BaseConstants::COUNTRY_ORIGIN,
            BaseConstants::CATEGORY_ID,
        ],[
            BaseConstants::NAME,
            BaseConstants::DESCRIPTION,
            BaseConstants::MRP,
            BaseConstants::SELLER_PRICE,
            BaseConstants::GST,
            BaseConstants::BRAND,
            BaseConstants::WEIGHT,
            BaseConstants::COUNTRY_ORIGIN,
            BaseConstants::CATEGORY_ID,
        ], $_POST[self::PRODUCT_DETAILS]);

        $errors = $this->getError();
        $inputValidationFields = array(
            BaseConstants::NAME => "input",
            BaseConstants::DESCRIPTION => "input",
            BaseConstants::BRAND => "input",
            BaseConstants::WEIGHT => "input",
            BaseConstants::COUNTRY_ORIGIN => "input",
            BaseConstants::MRP => "number",
            BaseConstants::SELLER_PRICE => "number",
            BaseConstants::GST => "number",
            BaseConstants::CATEGORY_ID => "number",
        );

        foreach($inputValidationFields as $key => $value) {
            if (!isset($errors[$key]))
                $_POST[self::PRODUCT_DETAILS][$key] = $this->validateFormData($value, $key, $_POST[self::PRODUCT_DETAILS][$key]);
        }

        if (empty($this->getError())) {
            $result = $this->vendorModel->add_productDetails();
            print_r(json_encode($result, true));
            exit;
        }

        print_r(json_encode(["success" => false, "error" => $this->getError()], true));*/
    }

    public function bulkUploadProducts()
    {
        print_r($_POST);
        print_r($_FILES);
        $fileMimes = array(
            'application/vnd.ms-excel','text/plain','text/csv','text/tsv'
        );

        if (!empty($_FILES['bulkUploadProducts']['name']) && in_array($_FILES['bulkUploadProducts']['type'], $fileMimes))
        {
            $csvFile = fopen($_FILES['bulkUploadProducts']['tmp_name'], 'r');
            $getHeader = fgetcsv($csvFile, 500, ",");
            $missingColumns = array_diff(array_keys(ProductCsvMapping::PRODUCT_COLUMN_MAPPING), $getHeader);
            if (!empty($missingColumns)) {
                $data["errors"]["Validation Error"] = ["Header Columns do not match with the template. Missing Header Column(s): ".implode(",", $missingColumns)];
            } else {
//                 Parse data from CSV file line by line
                $count = 0;
                $_POST["productdetails"]["category"] =$_POST["category"];
                unset($_POST["category"]);
                while (($getData = fgetcsv($csvFile, 500, ",")) !== FALSE) {
                    if ($count > 500) {
                        break;
                    }
                    foreach ($getData as $key => $value) {
                        echo ProductCsvMapping::PRODUCT_COLUMN_MAPPING[$getHeader[$key]];
                        switch(ProductCsvMapping::PRODUCT_COLUMN_MAPPING[$getHeader[$key]]) {
                            case BaseConstants::SIZE:
                            case BaseConstants::COLOR:
                            case BaseConstants::SKU_ID:
                            case BaseConstants::QUANTITY:
                            case BaseConstants::IMAGE_URL:
                                $_POST["productdetails"][ProductCsvMapping::PRODUCT_COLUMN_MAPPING[$getHeader[$key]]] = explode("#", $value);
                                break;

                            default:
                                $_POST["productdetails"][ProductCsvMapping::PRODUCT_COLUMN_MAPPING[$getHeader[$key]]] = trim($value);
                        }
                    }

                    $_POST["productdetails"]["valueCombination"] = $this->getCombinations(
                        $_POST["productdetails"][BaseConstants::SIZE],
                        $_POST["productdetails"][BaseConstants::COLOR]
                    );
                    $counter = count($_POST["productdetails"][BaseConstants::SIZE]) * count($_POST["productdetails"][BaseConstants::COLOR]);
                    if (count($_POST["productdetails"][BaseConstants::SKU_ID]) != $counter) {
                        $data["errors"]["Validation Error"] = ["Number of values passed to SKU Id is not equal to (Size * Color)"];
                    }
                    if (count($_POST["productdetails"][BaseConstants::QUANTITY]) != $counter) {
                        $data["errors"]["Validation Error"] = ["Number of values passed to Quantity is not equal to (Size * Color)"];
                    }
                    if (count($_POST["productdetails"][BaseConstants::IMAGE_URL]) != $counter) {
                        $data["errors"]["Validation Error"] = ["Number of values passed to Image Url is not equal to (Size * Color)"];
                    }

                    $count ++;
                }

                if (!$count) {
                    $data["errors"]["Validation Error"] = ["Uploaded File donot have any data to process"];
                }
                fclose($csvFile);
            }
        }
        else
        {
            $data["errors"]["Validation Error"] = ["Upload a file with only .csv extension"];
        }
        //echo "<pre>";print_r($_POST);echo "</pre>";die("Fdsfsd");
        if (empty($data["errors"])) {
            $this->vendorModel->add_productDetails();
        }
        $data['page_title']="Bulk Upload Products";
        $data['categories'] = $this->getCategories();
        $this->view("samrons/admin/bulkUploadProducts",$data);
        //$this->vendorModel->add_bulkProductDetails();
    }

    public function getOptions() {
        if (isset($_POST["source"]) && $_POST["source"] == "script") {
            print_r($this->vendorModel->get_options());
        } else {
            return $this->vendorModel->get_options();
        }
    }

    public function getCategories() {
        $parentId = 0;

        if(!empty($_POST["parentid"])) {
            $parentId = $_POST["parentid"];
        }
        if (isset($_POST["source"]) && $_POST["source"] == "script") {
            print_r($this->vendorModel->get_categories($parentId));
        } else {
            return $this->vendorModel->get_categories($parentId);
        }
    }

    public function bulkUploadImages() {
        $data['page_title']="Bulk Upload Images";
        $this->view("samrons/admin/bulkUploadImages",$data);
    }

    public function saveUploadedImages() {
        $this->vendorModel->save_uploaded_images();
    }

    public function getUploadedImagesUrl() {
        echo json_encode($this->vendorModel->get_uploaded_images_url(), true);
    }

    public function removeUploadedImages() {
        echo json_encode($this->vendorModel->remove_uploaded_images(), true);
    }

    public function downloadCSV() {
        $fileName = "product_details.csv";
        $delimiter = ",";

        $f = fopen('php://memory', 'w');
        // loop over the input array
        //foreach (ProductCsvMapping::PRODUCT_COLUMN_MAPPING  as $line) {
            // generate csv lines from the inner arrays
            fputcsv($f, array_keys(ProductCsvMapping::PRODUCT_COLUMN_MAPPING), $delimiter);
        //}
        // reset the file pointer to the start of the file
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: text/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$fileName.'";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
    }

}