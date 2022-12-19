<?php


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
        $data['desc']   = $_POST['desc'];
        $data['parentcat']   = $_POST['parentcat'];


        $query="insert into categories(parent_id,name,description) values (:parentcat,:cname,:desc)";
        $result=$this->db->write($query,$data);


        if(is_array($result)){
            $message = "You are Successfully Registered. Try Login after couple of hours after Admin Approval";
        }
    }
    public function add_productDetails()
    {

        $data = array();
        $productData=array();

        $urladd['url_address']=$_SESSION['url_address'];
        $query="select id from vendors where url_address=:url_address";
        $vendor_id = $this->db->read($query, $urladd);
        print_r($vendor_id[0]['id']);
        foreach($_POST as $id=>$value)
        {
            foreach ($value as $key=>$productInfo) {
                switch ($productInfo['name']) {
                    case "proname":
                    case "prodesc":
                    case "category":
                        $data[$productInfo['name']] = $productInfo['value'];
                        break;
                    case "options":
                    case "quantity":
                    case "price":
                    case "skuId":
                    case "valueCombination":

                        $data[$productInfo['name']][] = $productInfo['value'];
                        //$value = $productInfo['value'];
                        break;
                    case "optionvalues":
                        $valueArr = json_decode($productInfo['value'], true);
                        $value = [];
                        for($i = 0; $i < count($valueArr); $i ++)
                            $value[] = $valueArr[$i]["value"];
                        $data[$productInfo['name']][] =$value;
                }
                /*if (!isset($data[$productInfo['name']])) {
                    $data[$productInfo['name']] =$value;
                } else {
                    $previousValue = $data[$productInfo['name']];
                    $data[$productInfo['name']] = [$previousValue];
                    $data[$productInfo['name']][] = $value;;
                }*/
            }
        }
        print_r($data['valueCombination']);
        foreach ($data['valueCombination'] as $key=>  $value)
        {
            $valueCombinations[]=explode(",",$value);

        }
        print_r($valueCombinations);
        $productData['proname']=$data['proname'];
        $productData['prodesc']=$data['prodesc'];

        $productData['category_id']=$data['category'];
        $productData['vendor_id']=$vendor_id[0]['id'];
        $query="insert into products(name,description,category_id,vendor_id) values (:proname,:prodesc,:category_id,:vendor_id)";
        $productId=$this->db->write($query,$productData);
        $productOption['product_id']=$productId;
        foreach ($data['options'] as $key=>$optionId)
        {
            $productOption['option_id']=$optionId;
            $query = "insert into product_options(option_id,product_id) values (:option_id,:product_id)";
            $productOptionId[] = $this->db->write($query, $productOption);
            foreach ($data['optionvalues'][$key] as $optionValueName) {
                $query="insert into option_values(option_id,value_name) values (:optionId,:valueName)";
                $optionValueArr = ["optionId" => $optionId, "valueName" => $optionValueName];
                $optionValueId[] = $this->db->write($query, $optionValueArr);

            }
        }

        foreach ($data['skuId'] as $key=>$variantData) {
            $productVariant = array();
            $productVariant['product_id'] = $productId;
            $productVariant['quantity'] = $data['quantity'][$key];
            $productVariant['price'] = $data['price'][$key];
            $productVariant['skuId'] = $variantData;
            $productVariant['productImage']=$this->generateRandomString();
            $info = pathinfo($_FILES["productimage"]["name"][$key]);
            $ext = $info["extension"];
            $productVariant['productImage']=$productVariant['productImage'].$ext;
            print_r($productVariant);

            $query = "insert into product_variants(sku_id,product_id,quantity,price,product_image) values (:skuId,:product_id,:quantity,:price,:productImage)";
            $productVariantId[] = $this->db->write($query, $productVariant);
            if (!file_exists(FILEUPLOAD.$productVariantId[0])) {
                $dir_path = getcwd() . "/../app/uploads/";
                mkdir(getcwd() . "/../app/uploads/" . $productData['vendor_id']."/".$productData['vendor_id'] . "_" . $productVariantId[0], 0777, true);

                $info = pathinfo($_FILES["productimage"]["name"][$key]);
                $ext = $info["extension"];
                $filename = $productVariant['productImage']. "." . $ext;


                $target_dir = $dir_path .$productData['vendor_id']."/". $productData['vendor_id'] . "_" . $productVariantId[0] . "/" . $filename;
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
        if(!empty($data["tags"])) {

        }
print_r($data['proname']);


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