<?php

use App\Utils\BaseConstants;
use Ramsey\Uuid\Uuid;
require_once 'basemodel.class.php';

class vendormodel extends basemodel
{

    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function get_dashboardData() {
        $dashboardData = [];
        $activeVendorSql = "SELECT count(1) as count from order_items oi INNER JOIN vendors v on v.id = oi.vendor_id WHERE v.url_address = :url_address";
        $result = $this->db->read($activeVendorSql, ["url_address" => $_SESSION["url_address"]]);
        $dashboardData["header"][] = [
            "name" => "Orders Till Date",
            "count" => $result[0]["count"],
            "icon" => "pe-7s-cart"
        ];

        $activeVendorSql = "SELECT count(1) as count from order_items oi INNER JOIN vendors v on v.id = oi.vendor_id WHERE v.url_address = :url_address AND oi.status = :status";
        $result = $this->db->read($activeVendorSql, ["url_address" => $_SESSION["url_address"], "status" => "delivered"]);
        $dashboardData["header"][] = [
            "name" => "Active Orders",
            "count" => $result[0]["count"],
            "icon" => "pe-7s-cart"
        ];

        $activeVendorSql = "SELECT count(1) as count from order_items oi INNER JOIN vendors v on v.id = oi.vendor_id WHERE v.url_address = :url_address AND oi.status = :status";
        $result = $this->db->read($activeVendorSql, ["url_address" => $_SESSION["url_address"], "status" => "pending"]);
        $dashboardData["header"][] = [
            "name" => "Pending Orders",
            "count" => $result[0]["count"],
            "icon" => "pe-7s-cart"
        ];

        return $dashboardData;
    }

    public function add_categories()
    {
        $data = array();
        $_POST = array_map('trim', $_POST);

        $data['cname'] = $_POST['cname'];
        $data['description'] = $_POST['desc'];
        $data['parentcat'] = isset($_POST['category']) ? $_POST['category'] : 0;
        $data['catimage'] = $this->generateRandomString();
        $info = pathinfo($_FILES["categoryimage"]["name"]);
        $ext = $info["extension"];
        $data['catimage'] = $data['catimage'] . "." . $ext;
        $data['id'] = Uuid::uuid4();
        $query = "INSERT INTO categories(
                    id,
                    parent_id,
                    name,
                    description,
                    category_image
                    ) values (
                    :id,
                    :parentcat,
                    :cname,
                    :description,
                    :catimage)";

        $result = $this->db->write($query, $data);
        if (!empty($result)) {
            $dir_path = getcwd() . "/../app/uploads/";
            if (!is_dir(getcwd() . "/../app/uploads/category")){
                mkdir(getcwd() . "/../app/uploads/" . "category", 0777, true);
            }
            
            $filename = $data['catimage'];

            $target_dir = $dir_path . "category" . "/" . $filename;
            move_uploaded_file($_FILES["categoryimage"]["tmp_name"], $target_dir);

            return true;
        }

        return false;
    }

    public function remove_uploaded_images()
    {
        if (array_key_exists('url', $_POST)) {
            $filename = $_POST['url'];
            $directory = getcwd() . "/../app/uploads/bulk_images/" . $_SESSION["url_address"] . "/";
            if (file_exists($directory . $filename)) {
                unlink($directory . $filename);
                return $this->get_uploaded_images_url();
            } else {
                return ["success" => false];
            }
        }
        return ["success" => false];
    }

    public function get_uploaded_images_url()
    {
        $directory = getcwd() . "/../app/uploads/bulk_images/" . $_SESSION["url_address"] . "/";
        $images = glob($directory . "*.{jpg,png,jpeg}", GLOB_BRACE);
        $imgUrls = [];
        foreach ($images as $image) {
            $imgUrls[] = BaseConstants::BULK_UPLOAD_URL . "bulk_images/" . $_SESSION["url_address"] . "/" . str_replace($directory, "", $image);
        }

        return $imgUrls;
    }

    public function save_uploaded_images()
    {
        if (!empty($_FILES["bulkUploadImages"])) {
            foreach ($_FILES["bulkUploadImages"]["name"] as $key => $value) {
                $data["image_name"] = $this->generateRandomString();
                $info = pathinfo($value);
                $data["image_name"] .= "." . $info["extension"];

                $target_dir = getcwd() . "/../app/uploads/bulk_images/" . $_SESSION["url_address"] . "/" . $data["image_name"];
                if (!is_dir(getcwd() . "/../app/uploads/bulk_images")) {
                    mkdir(getcwd() . "/../app/uploads/bulk_images", 0777, true);
                }
                if (!is_dir(getcwd() . "/../app/uploads/bulk_images/" . $_SESSION["url_address"])) {
                    mkdir(getcwd() . "/../app/uploads/bulk_images/" . $_SESSION["url_address"], 0777, true);
                }

                move_uploaded_file($_FILES["bulkUploadImages"]["tmp_name"][$key], $target_dir);
            }
        }
    }

    public function get_productDetails()
    {
        $sql = "SELECT 
                    p.id, 
                    p.auto_id as product_auto_id,
                    p.name,
                    p.vendor_id,
                    v.auto_id as vendor_auto_id,
                    p.category_id,
                    p.mrp, 
                    p.seller_price, 
                    pv.id as variant_id,
                    pv.auto_id as variant_auto_id,
                    pv.quantity,
                    pv.product_image, 
                    c.name as category_name 
                FROM products as p 
                LEFT JOIN product_variants pv on p.id = pv.product_id 
                INNER JOIN vendors v ON v.id = p.vendor_id 
                INNER JOIN categories c on c.id = p.category_id 
               WHERE v.url_address = '" . $_SESSION["url_address"] . "'  and p.mrp>0 and p.seller_price>0 and pv.quantity>0";

        $limit = 3;

        $result = $this->db->read($sql);
        $productData = [];

        if (!empty($result)) {
            foreach ($result as $key => $value) {
                if (!isset($productData[$value["id"]])) {
                    $productData[$value["id"]] = [
                        "product_auto_id" => $value["product_auto_id"],
                        "name" => $value["name"],
                        "vendor_id" => $value["vendor_id"],
                        "vendor_auto_id" => $value["vendor_auto_id"],
                        "category_id" => $value["category_id"],
                        "mrp" => $value["mrp"],
                        "seller_price" => $value["seller_price"],
                        "category_name" => $value["category_name"]
                    ];
                }

                $productData[$value["id"]]["variant_data"][$value["variant_id"]] = [
                    "variant_auto_id" => $value["variant_auto_id"],
                    "quantity" => $value["quantity"],
                    "product_image" => $value["product_image"]
                ];
            }
        }

        return array_chunk($productData, $limit,true);
    }




    public function add_bulkProductDetails()
    {
    }

    public function add_productDetails()
    {
        try {
            //echo "<pre>";print_r($_POST);echo "</pre>";
            $data = array();
            $productData = array();

            $urladd['url_address'] = $_SESSION["url_address"];
            $query = "select id, auto_id from vendors where url_address=:url_address";
            $vendor_id = $this->db->read($query, $urladd);
            $query = "select id,name from options";
            $optionData = $this->db->read($query);

            foreach ($optionData as $key => $value) {
                $optionDataArr[$value['id']] = $value['name'];
                $optionDataRevArr[$value['name']] = $value["id"];
            }
            $productInfo = [];
            foreach ($_POST["productdetails"] as $column => $columnValue) {
                switch ($column) {
                    case "size":
                    case "color":
                        $variantData["options"][] = $optionDataRevArr[ucfirst($column)];
                        unset($_POST["productdetails"][$column]);
                        break;
                    case "image_url":
                    case "options":
                    case "quantity":
                    case "skuId":
                    case "valueCombination":
                        $variantData[$column] = array_values($columnValue);
                        //$data[$productInfo['name']][] = $productInfo['value'];
                        //$value = $productInfo['value'];
                        break;
                    case "optionvalues":
//                    $columnValue = array_values($columnValue);
//                    for($i = 0; $i < count($columnValue); $i++) {
//                        $valueArr = json_decode($columnValue[$i], true);
//                        $value = [];
//                        for($j = 0; $j < count($valueArr); $j ++)
//                            $value[] = $valueArr[$j]["value"];
//                        $options[$column][] = $value;
//                    }
                        break;
                    default:
                        $data[$column] = strip_tags($columnValue);
                }
            }

            $data["tag"] = "";
            foreach ($data as $key1 => $value1) {
                if (!in_array($key1, ["description", "category", "vendor_id", "gst", "weight"]))
                    $data["tag"] .= $value1 . " ";
            }


            $data["final_price"] = $data["seller_price"] + 50;
            $data["amount_to_seller"] = $this->getAmountToSeller((int)$data["seller_price"]);


            $data['vendor_id'] = $vendor_id[0]['id'];
            $data['id'] = Uuid::uuid4();
            $query = "INSERT INTO products(
                id,
                name,
                description,
                category_id,
                vendor_id,
                mrp,
                collar,
                seller_price,
                gst,
                brand,
                weight,
                style_code,
                fabric,
                sleeve_length,
                country_origin,
                fit_shape,
                occasion,
                pattern_type,
                packers_detail,
                neck,
                solid,
                length,
                tag,
                final_price,
                amount_to_seller       
            ) values (
                :id,
                :name,
                :description,
                :category,
                :vendor_id,
                :mrp,
                :collar,
                :seller_price,
                :gst,
                :brand,
                :weight,
                :style_code,
                :fabric,
                :sleeve_length,
                :country_origin,
                :fit_shape,
                :occasion,
                :pattern_type,
                :packers_detail,
                :neck,
                :solid,
                :length,
                :tag,
                :final_price,
                :amount_to_seller
            )";

            $productId = $this->db->write($query, $data);
            if (empty($productId)) {
                return ["success" => false, "error" => "Could not save product"];
            }
            $productOption['product_id'] = $data['id'];
//        foreach ($variantData['options'] as $key=>$optionId)
//        {
//            $productOption['option_id']=$optionId;
//            $query = "insert into product_options(option_id,product_id) values (:option_id,:product_id)";
//            $productOptionId[] = $this->db->write($query, $productOption);
//            foreach ($options['optionvalues'][$key] as $optionValueName) {
//                $query="insert into option_values(option_id,value_name) values (:optionId,:valueName)";
//                $optionValueArr = ["optionId" => $optionId, "valueName" => $optionValueName];
//                $optionValueId[] = $this->db->write($query, $optionValueArr);
//
//            }
//        }

            foreach ($variantData['skuId'] as $key => $variantsData) {

                if (!is_array($variantData['valueCombination'][$key]))
                    $valueCombination = explode(",", $variantData['valueCombination'][$key]);
                else {
                    $valueCombination = $variantData['valueCombination'][$key];
                }

                $combination = "";
                foreach ($variantData['options'] as $index => $value) {
                    $combination .= $optionDataArr[$value] . ":" . $valueCombination[$index] . ",";
                }
                $productVariant = array();
                $productVariant['product_id'] = $data['id'];
                $productVariant['quantity'] = $variantData['quantity'][$key];

                $productVariant['skuId'] = $variantsData;
                if (isset($variantData['image_url'])) {
                    $productVariantImageUrl['url'] = $productVariant['productImage'] = $variantData['image_url'][$key];
                    unset($variantData['image_url'][$key]);
                } else {
                    $info = pathinfo($_FILES["productimage"]["name"][$key]);
                    $ext = $info["extension"];
                    $productVariant['productImage'] = $this->generateRandomString().".".$ext;
                }

                $productVariant["combination"] = trim($combination, ",");
                $productVariant["id"] = Uuid::uuid4();
                $query = "INSERT INTO product_variants(
                    id,
                    sku_id,
                    product_id,
                    quantity,
                    product_image, 
                    combination
                ) values (
                    :id,
                    :skuId,
                    :product_id,
                    :quantity,
                    :productImage,
                    :combination
                )";
                $productVariantId[] = $this->db->write($query, $productVariant);
                if (empty($productVariantId[$key])) {
                    return ["success" => false, "error" => "Could not save product variant"];
                }

                if (!is_dir(getcwd() . "/../app/uploads/" . $vendor_id[0]['auto_id'] . "/" . $productId . "_" . $productVariantId[$key])) {
                    mkdir(getcwd() . "/../app/uploads/" . $vendor_id[0]['auto_id'] . "/" . $productId . "_" . $productVariantId[$key], 0777, true);
                }
                if (!empty($productVariantImageUrl['url'])) {
                    $oldFile = getcwd() . "/../app/uploads/bulk_images/" . $urladd['url_address'] . "/" . $productVariantImageUrl['url'];
                    $dummyImgPath = getcwd() . "/../app/uploads/bulk_images/dummy-product.jpg";
                    $newName = getcwd() . "/../app/uploads/" . $vendor_id[0]['auto_id'] . "/" . $productId . "_" . $productVariantId[$key] . "/" . $productVariantImageUrl['url'];
                    $renamed = false;
                    if ( file_exists($oldFile) && is_readable($oldFile) ) {
                        $renamed = rename($oldFile, $newName);
                    }

                    if(!$renamed) {
                        copy($dummyImgPath , $newName);
                    }
                } else {

                    $dir_path = getcwd() . "/../app/uploads/";

                    $filename = $productVariant['productImage'];
                    $target_dir = $dir_path .$vendor_id[0]['auto_id']."/". $productId . "_" . $productVariantId[$key] . "/" . $filename;
                    $moved = move_uploaded_file($_FILES["productimage"]["tmp_name"][$key], $target_dir);
                    if (!$moved) {
                        $dummyImgPath = getcwd() . "/../app/uploads/bulk_images/dummy-product.jpg";
                        $newName = getcwd() . "/../app/uploads/" . $vendor_id[0]['auto_id'] . "/" . $productId . "_" . $productVariantId[$key] . "/" . $productVariantImageUrl['url'];
                        copy($dummyImgPath , $newName);
                    }
                }
            }
//            $variantValues = array();
//            $variantValues['product_id'] = $productId;
//            foreach ($productVariantId as $key => $variantValue) {
//
//                $variantValues['value_id'] = $optionValueId[$key];
//                $variantValues['variant_id'] = $variantValue;
//                $query = "insert into variant_values(variant_id,product_id,value_id) values (:variant_id,:product_id,:value_id)";
//                $productVariantId[] = $this->db->write($query, $variantValues);
//            }
//
//            if (!empty($data["tags"])) {
//
//            }


            /* $db=Database::getInstance();
             $query="insert into categories(parent_id,name,description) values (:parentcat,:cname,:desc)";
             $result=$db->write($query,$data);


             if(is_array($result)){
                 $message = "You are Successfully Registered. Try Login after couple of hours after Admin Approval";
             }*/
            return ["success" => true, "message" => "Product Added Successfully"];
        } catch (Exception $e) {
            return ["success" => false, "error" => "Could Not Save Product and its variants"];
        }
    }

    public function get_categories($parentid)
    {
        $data['parent_id'] = $parentid;
        //$db=Database::getInstance();
        $sql = "select id,parent_id,name from categories where parent_id=:parent_id";
        $categories = $this->db->read($sql, $data);
        if (is_array($categories)) {
            return json_encode($categories, true);
        }
    }

    public function get_optionvalues($optionid)
    {
        $data['option_id'] = $optionid;

        $sql = "select id,value_name from option_values where option_id=:option_id";
        $optionvalues = $this->db->read($sql, $data);

        if (is_array($optionvalues)) {
            return json_encode($optionvalues, true);
        }
    }
    public function get_orderDetails($vendor_id)
    {
        $sql = "select oi.auto_id as id,
            o.timestamps ,
            oi.item_quantity,
            oi.price,
            oi.variant_id,
            oi.vendor_id,
            pv.product_id,
            ua.add_line_1,
            ua.add_line_2,
            ua.country,
            ua.state,
            ua.city,
            ua.pincode,
            pv.product_image from order_items oi 
            left join orders o on oi.order_id=o.id  
            inner join user_address ua on o.shipping_address_id=ua.id  
            inner join vendors v on oi.vendor_id = v.id
            inner join product_variants pv on oi.variant_id=pv.id where v.url_address = '" . $vendor_id . "' ";

        $limit = 2;

        $orderData = $this->db->read($sql);
        if (!empty($orderData)) {
            return array_chunk($orderData, $limit);
        } else {
            return [];
        }
    }

    public function updateQuantityPrice()
    {
        $updatedata['id'] = $_POST["id"];
        $updatedata['quantity'] = $_POST["quantity"];


        $sql = "UPDATE product_variants SET quantity=:quantity WHERE id=:id";
        $this->db->write($sql, $updatedata);


        $updatepdata['price'] = $_POST["price"];
        $updatepdata['mrp'] = $_POST["mrp"];
        $updatepdata['proid'] = $_POST["proid"];
        $query = "UPDATE products SET seller_price=:price,mrp=:mrp WHERE id=:proid";
        $this->db->write($query, $updatepdata);


        return ["success" => true, "message" => "Updated Successfully"];


    }


    public function get_options()
    {

        //$db=Database::getInstance();
        $sql = "select id,name from options ";
        $options = $this->db->read($sql);

        if (is_array($options)) {
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
    function getOneLevel($catId){
        $data['parentcatid']=$catId;

        $query="SELECT id FROM categories WHERE parent_id=:parentcatid";

        $catIdArr= $this->db->read($query, $data);
        $catIds = [];

        if(is_array($catIdArr)){
            foreach ($catIdArr as $key=>$value){
                $catIds[]=$value['id'];
            }
        }

        return $catIds;
    }

    function getChildren($parent_id, $tree_string=array()) {
        $tree = array();
        // getOneLevel() returns a one-dimensional array of child ids
        $tree = $this->getOneLevel($parent_id);
        if(count($tree)>0 && is_array($tree)){
            $tree_string=array_merge($tree_string,$tree);
        }
        foreach ($tree as $key => $val) {
            $this->getChildren($val, $tree_string);
        }

        return $tree_string;
    }

    public function getAmountToSeller ($sellerPrice) {
        switch ($sellerPrice) {
            case $sellerPrice > 0 && $sellerPrice <= 100:
                $amountToSeller = ($sellerPrice - (20 / 100) * $sellerPrice);
                break;
            case $sellerPrice > 100 && $sellerPrice <= 300:
                $amountToSeller = ($sellerPrice - (10 / 100) * $sellerPrice);
                break;
            case $sellerPrice > 300 && $sellerPrice <= 400:
                $amountToSeller = ($sellerPrice - (8 / 100) * $sellerPrice);
                break;
            case $sellerPrice > 400 && $sellerPrice <= 600:
                $amountToSeller = ($sellerPrice - (6 / 100) * $sellerPrice);
                break;
            case $sellerPrice > 600 && $sellerPrice <= 1000:
                $amountToSeller = ($sellerPrice - (5 / 100) * $sellerPrice);
                break;
            default:
                $amountToSeller = ($sellerPrice - (2 / 100) * $sellerPrice);
                break;
        }

        return $amountToSeller;
    }

    function searchProducts($searchText)
    {
        $query = 'SELECT *,pv.id as variant_id FROM products as p left join product_variants as pv on p.id=pv.product_id WHERE p.tag like "%' . $searchText . '%" and pv.quantity>0';
        print_r($query);
        $catIdArr = $this->db->read($query);
        if (is_array($catIdArr)) {
            $productDetails = [];

            foreach ($catIdArr as $key => $value) {
                $productDetails[$value['product_id']] = $value;
            }
            return $productDetails;
        }
    }

    function getProductDataForShop($categoryIds,$type){

        if ($type == 'shop') {

            $query='SELECT 
                    p.auto_id as product_auto_id,
                    pv.auto_id as variant_auto_id,
                    v.auto_id as vendor_auto_id,
                    pv.product_image,
                    p.name,
                    p.mrp,
                    p.final_price,
                    pv.product_id,
                    pv.id as variant_id 
                    FROM products as p 
                    LEFT JOIN product_variants as pv ON p.id=pv.product_id 
                    INNER JOIN vendors v ON v.id = p.vendor_id
                    WHERE p.category_id in("'.$categoryIds.'") and pv.quantity > 0';

            $catIdArr= $this->db->read($query);
            if (is_array($catIdArr) ) {
                $productDetails = [];

                foreach ($catIdArr as $key => $value) {
                    $productDetails[$value['product_id']] = $value;
                }
                return $productDetails;
            }}

        elseif ($type=='detail')
        {
            $query='SELECT 
                        p.auto_id as product_auto_id,
                        v.auto_id as vendor_auto_id,
                        p.name,
                        p.mrp,
                        p.final_price,
                        p.description,
                        group_concat(pv.auto_id SEPARATOR "|") AS variant_auto_id, 
                        group_concat(pv.id SEPARATOR "|") AS variant_id, 
                        group_concat(quantity SEPARATOR "|") AS quantity, 
                        group_concat(combination SEPARATOR "|") AS combination,
                        group_concat(product_image SEPARATOR "|") AS image 
                        FROM product_variants AS pv 
                        INNER JOIN products AS p on p.id=pv.product_id 
                        INNER JOIN vendors v ON v.id = p.vendor_id
                        WHERE p.id="'.$categoryIds.'" group by p.auto_id, v.auto_id';
            $productDetailsArr= $this->db->read($query);

            if (is_array($productDetailsArr) ){
                $variantOption=[];
                $variantIds=[];
                $variantImages=[];
                $quantity = [];
                foreach($productDetailsArr as $key => $value) {
                    $variantCombinations = explode( "|",$value["combination"]);
                    $variantImages = explode( "|",$value["image"]);
                    $variantIds = explode( "|",$value["variant_id"]);
                    $variantAutoIds = explode( "|",$value["variant_auto_id"]);
                    $quantity = explode( "|",$value["quantity"]);
                    $variantWithCombination = [];
                    foreach($variantCombinations as $key1 => $value1) {
                        $combinationArr = explode(",", $value1);
                        foreach ($combinationArr as $value2) {
                            list($varaintname, $variantvalue) = explode(":", $value2);
                            if (isset($variantWithCombination[$variantIds[$key1]])) {
                                $variantWithCombination[$variantIds[$key1]] .= $variantvalue;
                            } else {
                                $variantWithCombination[$variantIds[$key1]] = [];
                                $variantWithCombination[$variantIds[$key1]] = $variantvalue;
                            }
                            if (empty($variantOption[$varaintname]) || (!empty($variantOption[$varaintname]) && !in_array($variantvalue, $variantOption[$varaintname])))
                                $variantOption[$varaintname][] = $variantvalue;

                        }
                    }
                    unset($productDetailsArr[$key]["combination"]);
                    unset($productDetailsArr[$key]["image"]);
                    unset($productDetailsArr[$key]["variant_id"]);
                    unset($productDetailsArr[$key]["quantity"]);
                }

                return [$productDetailsArr, $variantIds, $variantOption, $variantImages, $quantity, $variantWithCombination, $variantAutoIds];
            }
        }
    }
}