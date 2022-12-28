<?php
use App\Utils\BaseConstants;

class vendormodel
{

    private $db;

    public function  __construct() {
        $this->db = Database::getInstance();
    }

    public function add_categories()
    {
        $data = array();
        $_POST = array_map('trim', $_POST);

        $data['cname']  = $_POST['cname'];
        $data['description']   = $_POST['desc'];
        $data['parentcat']   = isset($_POST['category']) && ctype_digit($_POST['category'])? $_POST['category']: 0;
        $data['catimage'] =$this->generateRandomString();
        $info = pathinfo($_FILES["categoryimage"]["name"]);
        $ext = $info["extension"];
        $data['catimage']=$data['catimage'].".".$ext;

        $query="INSERT INTO categories(
                    parent_id,
                    name,
                    description,
                    category_image
                    ) values (
                    :parentcat,
                    :cname,
                    :description,
                    :catimage)";

        $result=$this->db->write($query,$data);
        if (!empty($result) ) {
            $dir_path = getcwd() . "/../app/uploads/";
            if (!file_exists(getcwd() . "/../app/uploads/category")) {
                mkdir(getcwd() . "/../app/uploads/" . "category", 0777, true);
            }
            $filename = $data['catimage'];

            $target_dir = $dir_path ."category" . "/" . $filename;
            move_uploaded_file($_FILES["categoryimage"]["tmp_name"][0], $target_dir);

            return true;
        }

        return false;
    }

    public function remove_uploaded_images() {
        if (array_key_exists('url', $_POST)) {
            $filename = $_POST['url'];
            $directory = getcwd(). "/../app/uploads/bulk_images/".$_SESSION["url_address"]."/";
            if (file_exists($directory.$filename)) {
                unlink($directory.$filename);
                return $this->get_uploaded_images_url();
            } else {
                return ["success" => false];
            }
        }
        return ["success" => false];
    }

    public function get_uploaded_images_url() {
        $directory = getcwd(). "/../app/uploads/bulk_images/".$_SESSION["url_address"]."/";
        $images = glob($directory . "*.{jpg,png,jpeg}", GLOB_BRACE);
        $imgUrls = [];
        foreach($images as $image)
        {
            $imgUrls[] = BaseConstants::BULK_UPLOAD_URL."bulk_images/".$_SESSION["url_address"]."/".str_replace($directory, "",$image);
        }

        return $imgUrls;
    }

    public function save_uploaded_images() {
        if (!empty($_FILES["bulkUploadImages"])) {
            foreach ($_FILES["bulkUploadImages"]["name"] as $key => $value) {
                $data["image_name"] = $this->generateRandomString();
                $info = pathinfo($value);
                $data["image_name"] .= ".".$info["extension"];

                $target_dir = getcwd(). "/../app/uploads/bulk_images/".$_SESSION["url_address"]."/".$data["image_name"];
                if (!is_dir(getcwd(). "/../app/uploads/bulk_images")) {
                    mkdir(getcwd() . "/../app/uploads/bulk_images", 0777, true);
                }
                if(!is_dir(getcwd(). "/../app/uploads/bulk_images/".$_SESSION["url_address"])) {
                    mkdir(getcwd(). "/../app/uploads/bulk_images/".$_SESSION["url_address"], 0777, true);
                }

                move_uploaded_file($_FILES["bulkUploadImages"]["tmp_name"][$key], $target_dir);
            }
        }
    }

    public function get_productDetails($productId = "") {
        $sql = "SELECT 
                    p.id, 
                    p.name, 
                    p.description, 
                    pv.quantity, 
                    pv.price, 
                    pv.product_image, 
                    o.name AS option_name, 
                    ov.value_name
                FROM products p 
                LEFT JOIN product_variants pv 
                    ON p.id = pv.product_id 
                INNER JOIN vendors ven 
                    ON p.vendor_id = ven.id
                    AND ven.url_address = 'ojmcQKenIh'
                LEFT JOIN variant_values vv 
                    ON pv.id = vv.variant_id 
                LEFT JOIN option_values ov 
                    ON ov.id = vv.value_id 
                LEFT JOIN options o 
                    ON o.id = ov.option_id WHERE ven.url_address = 'ojmcQKenIh'";
    }

    public function add_bulkProductDetails() {
    }

    public function add_productDetails()
    {
        print_r($_POST);
        $data = array();
        $productData=array();

        $urladd['url_address']='ojmcQKenIh';
        $query="select id from vendors where url_address=:url_address";
        $vendor_id = $this->db->read($query, $urladd);
        print_r($vendor_id[0]['id']);
        $productInfo=[];
        foreach($_POST["productdetails"] as $column => $columnValue)
        {
            switch ($column) {
                case "options":
                case "quantity":
                case "skuId":
                case "valueCombination":
                    $variantData[$column] = array_values($columnValue);
                    //$data[$productInfo['name']][] = $productInfo['value'];
                    //$value = $productInfo['value'];
                    break;
                case "optionvalues":
                    $columnValue = array_values($columnValue);
                    for($i = 0; $i < count($columnValue); $i++) {
                        $valueArr = json_decode($columnValue[$i], true);
                        $value = [];
                        for($j = 0; $j < count($valueArr); $j ++)
                            $value[] = $valueArr[$j]["value"];
                        $options[$column][] = $value;
                    }
                    break;
                default:
                    $data[$column] = $columnValue;
            }
                /*if (!isset($data[$productInfo['name']])) {
                    $data[$productInfo['name']] =$value;
                } else {
                    $previousValue = $data[$productInfo['name']];
                    $data[$productInfo['name']] = [$previousValue];
                    $data[$productInfo['name']][] = $value;;
                }*/

        }
         print_r($options);
        /*print_r($data['valueCombination']);
        foreach ($data['valueCombination'] as $key=>  $value)
        {
            $valueCombinations[]=explode(",",$value);

        }
        print_r($valueCombinations);*/
        /*$productData['proname']=$data['proname'];
        $productData['prodesc']=$data['prodesc'];

        $productData['category_id']=$data['category'];*/
        $data['vendor_id']=$vendor_id[0]['id'];

        $query="insert into products(name,description,category_id,vendor_id,mrp,collar,seller_price,gst,brand,weight,style_code,fabric,sleeve_lenght,country_origin,fit_shape,occasion,pattern_type,packers_detail)
 values (:name,:description,:category,:vendor_id,:mrp,:collar,:seller_price,:gst,:brand,:weight,:style_code,:fabric,:sleeve_length,:country_origin,:fit_shape,:occasion,
:pattern_type,:packers_detail)";
        $productId=$this->db->write($query,$data);
        print_r($productId);
        $productOption['product_id']=$productId;
        foreach ($variantData['options'] as $key=>$optionId)
        {
            $productOption['option_id']=$optionId;
            $query = "insert into product_options(option_id,product_id) values (:option_id,:product_id)";
            $productOptionId[] = $this->db->write($query, $productOption);
            foreach ($options['optionvalues'][$key] as $optionValueName) {
                $query="insert into option_values(option_id,value_name) values (:optionId,:valueName)";
                $optionValueArr = ["optionId" => $optionId, "valueName" => $optionValueName];
                $optionValueId[] = $this->db->write($query, $optionValueArr);

            }
        }
print_r($optionValueId);
        foreach ($variantData['skuId'] as $key=>$variantsData) {
            $productVariant = array();
            $productVariant['product_id'] = $productId;
            $productVariant['quantity'] = $variantData['quantity'][$key];

            $productVariant['skuId'] = $variantsData;
            $productVariant['productImage']=$this->generateRandomString();
            $info = pathinfo($_FILES["productimage"]["name"][$key]);
            $ext = $info["extension"];
            $productVariant['productImage']=$productVariant['productImage'].$ext;
            print_r($productVariant);

            $query = "insert into product_variants(sku_id,product_id,quantity,product_image) values (:skuId,:product_id,:quantity,:productImage)";
            $productVariantId[] = $this->db->write($query, $productVariant);
            if (!file_exists(FILEUPLOAD.$productVariantId[0])) {
                $dir_path = getcwd() . "/../app/uploads/";
                mkdir(getcwd() . "/../app/uploads/" . $data['vendor_id']."/".$data['vendor_id'] . "_" . $productVariantId[0], 0777, true);

                $info = pathinfo($_FILES["productimage"]["name"][$key]);
                $ext = $info["extension"];
                $filename = $productVariant['productImage']. "." . $ext;


                $target_dir = $dir_path .$data['vendor_id']."/". $data['vendor_id'] . "_" . $productVariantId[0] . "/" . $filename;
                move_uploaded_file($_FILES["productimage"]["tmp_name"][$key], $target_dir);
            }
        }
        $variantValues=array();
        $variantValues['product_id']=$productId;
        foreach ($productVariantId as $key=>$variantValue){

        $variantValues['value_id']=$optionValueId[$key];
        $variantValues['variant_id']=$variantValue;
            $query = "insert into variant_values(variant_id,product_id,value_id) values (:variant_id,:product_id,:value_id)";
            $productVariantId[] = $this->db->write($query, $variantValues);
        }
        print_r($productVariantId);
        if(!empty($data["tags"])) {

        }



       /* $db=Database::getInstance();
        $query="insert into categories(parent_id,name,description) values (:parentcat,:cname,:desc)";
        $result=$db->write($query,$data);


        if(is_array($result)){
            $message = "You are Successfully Registered. Try Login after couple of hours after Admin Approval";
        }*/
    }

    public function get_categories($parentid)
    {
        $data['parent_id']=$parentid;
        //$db=Database::getInstance();
        $sql="select id,parent_id,name from categories where parent_id=:parent_id";
        $categories = $this->db->read($sql, $data);
        if (is_array($categories) )
        {
            return json_encode($categories, true);
        }
    }
    public function get_optionvalues($optionid)
    {
        $data['option_id']=$optionid;

        $sql="select id,value_name from option_values where option_id=:option_id";
        $optionvalues = $this->db->read($sql, $data);

        if (is_array($optionvalues) )
        {
            return json_encode($optionvalues, true);
        }
    }
    public function get_options()
    {

        //$db=Database::getInstance();
        $sql="select id,name from options ";
        $options = $this->db->read($sql);

        if (is_array($options) )
        {
            return json_encode($options, true);
        }
    }
    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}