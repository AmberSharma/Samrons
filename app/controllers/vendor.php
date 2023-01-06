<?php

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
       /* $this->validateFieldExists([
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
        }*/
        $this->vendorModel->add_productDetails();
       /* if (empty($this->getError())) {
            if ($this->vendorModel->add_productDetails()) {
                print_r(json_encode(["success" => true, "message" => "Product Added Successfully"], true));
            }
        }

        print_r(json_encode(["success" => false, "error" => $this->getError()], true));*/
    }

    public function addBulkProducts()
    {
        $data['page_title']="Add Bulk Products";
        $data['categories'] = $this->getCategories();
        $this->view("samrons/admin/addBulkProducts",$data);
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

}