<?php

use App\Utils\BaseConstants;
use Ramsey\Uuid\Uuid;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    private $error = "";

    public function get_categories($parentid)
    {
        $data['parent_id'] = $parentid;

        $sql = "SELECT id,parent_id,name,category_image 
                FROM " . BaseConstants::CATEGORY_TABLE . " 
                WHERE parent_id=:parent_id";

        $categories = $this->db->read($sql, $data);
        if (is_array($categories)) {
            return json_encode($categories, true);
        }

        return json_encode([]);
    }
    /*public function getColorAndSize($variantId)
    {
        $sql = 'SELECT pv.combination
                        FROM product_variants as pv left join products p on p.id=pv.product_id
                        WHERE pv.id in('.$variantId.')';
        $variantData = $this->db->read($sql);

        foreach($variantData as $key => $value) {
            $variantCombinations = explode( "|",$value["combination"]);


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
    }}*/
        public function getVariantData($variantId)
        {
            print_r($variantId);
            $sql = 'SELECT p.name, p.seller_price,p.vendor_id,pv.id as variant_id,sku_id,product_id,quantity,product_image, combination
                        FROM product_variants as pv left join products p on p.id=pv.product_id
                        WHERE pv.id in('.$variantId.')';
            $variantData = $this->db->read($sql);
            return $variantData;
        }
    public function getAddresses($userUrlAddress)
    {
        print_r($userUrlAddress);
        $data['url_add']=$userUrlAddress;
        $sql = 'SELECT *
                        FROM user_address 
                        WHERE url_add =:url_add';
        $addressData = $this->db->read($sql,$data);
        return $addressData;
    }
        public function addAdress()
        {
            $data=array();
            $data['add_line_1']=$_POST['add_line_1'];
            $data['add_line_2']=$_POST['add_line_2'];
            $data['country']=$_POST['country'];
            $data['state']=$_POST['state'];
            $data['city']=$_POST['city'];
            $data['pincode']=$_POST['pincode'];
            $data['url_add']=$_SESSION['url_address'];
            $data['id']=Uuid::uuid4();
            $query="insert into user_address(id,add_line_1,add_line_2,country,state,city,pincode,url_add) values(:id,:add_line_1,:add_line_2,:country,:state,:city,:pincode,:url_add)";
            $result = $this->db->write($query, $data);

            return $result;
        }
    public function saveOrder($orderData)
    {
        $data=array();
        $data1=array();
        $data['shipping_address_id']=$orderData['addressId'];
        $data['user_url_add']=$_SESSION['url_address'];
        $data['status']="paid";
        $data['payment_type']="COD";
        $productData=$this->getVariantData($orderData['variantIds']);

        //print_r($productData);
        $total=0;


        foreach ($productData as $value)
        {


            $total=($value['seller_price']*$_SESSION['variantdata'][$value['variant_id']])+$total;


        }
        $data['total']=$total;
        $data['timestamps']=date("Y-m-d H:i:s");
        $data['id']= Uuid::uuid4();

        $query="insert into orders(id, total,shipping_address_id,status,payment_type,user_url_add,timestamps ) values(:id,:total,:shipping_address_id,:status,:payment_type,:user_url_add,:timestamps)";
        $orderid = $this->db->write($query, $data);

        $data1['order_id']=$orderid;
        foreach ($productData as $value)
        {
            $data1['variant_id']=$value['variant_id'];
            $data1['item_quantity']=$_SESSION['variantdata'][$value['variant_id']];
            $data1['price']=$value['seller_price'];
            $data1['id']= Uuid::uuid4();
            $query="insert into order_items(id, order_id, variant_id,item_quantity,price) values(:id,:order_id, :variant_id,:item_quantity,:price)";
            $order_item_ids[] = $this->db->write($query, $data1);
        }

        return $order_item_ids;

    }
    public function sign_up()
    {
        $data = array();
        $_POST = array_map('trim', $_POST);
        $data['uemail'] = $_POST['uemail'];
        $data['uname'] = $_POST['uname'];
        $data['upass'] = $_POST['upass'];
        $data['uphone'] = $_POST['uphone'];


        $data['url_address'] = $this->generateRandomString();
        $data['date'] = date('y-m-d H:i:s');
        $data['upass'] = hash('sha1', $data['upass']);
        $data['id'] = Uuid::uuid4();

        if ($_POST['chktype'] == 'Vendor') {
            $data['aadhar'] = $_POST['aadhar'];
            $data['pancard'] = $_POST['pancard'];
            $data['gst'] = $_POST['gst'];
            $data['caccountnumber'] = $_POST['caccountnumber'];
            $data['cancelcheque'] = $this->generateRandomString();
            $data['photo'] = $this->generateRandomString();
            $data['sign'] = $this->generateRandomString();
            $data['status'] = 0;
            $data['type'] = 2;
            $query = "INSERT INTO " . BaseConstants::VENDOR_TABLE . " (
                    id,
                    url_address,
                    create_datetime,
                    name,
                    email,
                    password,
                    phone_number,
                    aadhar,
                    pancard,
                    gst,
                    cheque,
                    photo,
                    signature,
                    current_account_number,
                    status,
                    type) 
                values (
                    :id,
                    :url_address,
                    :date,
                    :uname,
                    :uemail,
                    :upass,
                    :uphone,
                    :aadhar,
                    :pancard,
                    :gst,
                    :cancelcheque,
                    :photo,
                    :sign,
                    :caccountnumber,
                    :status,
                    :type)";
            $result = $this->db->write($query, $data);

            if (!file_exists(FILEUPLOAD . $result)) {
                $dir_path = getcwd() . "/../app/uploads/";
                mkdir(getcwd() . "/../app/uploads/" . $result, 0777, true);

                $info = pathinfo($_FILES["cancelcheque"]["name"]);
                $ext = $info["extension"];
                $filename = $data['cancelcheque'] . "." . $ext;


                $target_dir = $dir_path . $result . "/" . $filename;
                move_uploaded_file($_FILES["cancelcheque"]["tmp_name"], $target_dir);

                $info = pathinfo($_FILES["photo"]["name"]);
                $ext = $info["extension"];
                $filename = $data['photo'] . "." . $ext;


                $target_dir = $dir_path . $result . "/" . $filename;
                move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir);

                $info = pathinfo($_FILES["sign"]["name"]);
                $ext = $info["extension"];
                $filename = $data['sign'] . "." . $ext;


                $target_dir = $dir_path . $result . "/" . $filename;
                move_uploaded_file($_FILES["sign"]["tmp_name"], $target_dir);

                chmod(getcwd() . "/../app/uploads/" . $result, 0777);

                $uploadOk = 1;

            }
            if (!empty($result)) {
                $message = "You are Successfully Registered. Try Login after couple of hours after Admin Approval";
                header("Location:" . ROOT . "signup?message={$message}");
            }
        } else {
            $query = "INSERT INTO users (
                        id,
                        url_address,
                        create_datetime,
                        name,
                        email,
                        password,
                        phone_number ) 
                    values (
                        :id,
                        :url_address,
                        :date,
                        :uname,
                        :uemail,
                        :upass,
                        :uphone )";

            $result = $this->db->write($query, $data);

            if (!empty($result)) {
                $message = "You are Successfully Registered. Please Proceed to Login";
                header("Location:signup?message={$message}");
            }
        }
    }


    public function check_email($email, $usertype)
    {
        if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            return "Email is not in valid format";
        } else {
            $table = BaseConstants::VENDOR_TABLE;
            if ($usertype == "User") {
                $table = BaseConstants::USER_TABLE;
            }

            $sql = "SELECT count(1) as count FROM " . $table . " WHERE email=:uemail";
            $arr['uemail'] = $email;
            $checkIfEmailExists = $this->db->read($sql, $arr);
            if (is_array($checkIfEmailExists) && $checkIfEmailExists[0]["count"] != 0) {
                return "This email is already registered";
            }
        }

        return true;

    }

    public function check_phone($phone, $usertype)
    {
        if (preg_match("/^\\+?[1-9][0-9]{7,14}$/", $phone) == false) {
            return "Phone Number is not valid";
        } else {
            $table = BaseConstants::VENDOR_TABLE;
            if ($usertype == "User") {
                $table = BaseConstants::USER_TABLE;
            }

            $sql = "SELECT count(1) as count FROM " . $table . " WHERE phone_number=:uphone";

            $arr['uphone'] = $phone;
            $checkIfPhoneExists = $this->db->read($sql, $arr);
            if (is_array($checkIfPhoneExists) && $checkIfPhoneExists[0]['count'] != 0) {
                return "This Phone Number is already registered";
            }
        }

    }

    public function check_pass($pass)
    {
        if (empty($pass) || preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $pass) == false) {
            return "Password must contain<br/>- Minimum eight characters<br/>- Atleast one letter<br/>- One number and one special character";
        }

        return "";
    }


    public function login()
    {

        $data = array();
        $phone = 0;

        $data['upass'] = trim($_POST['ulpass']);


        if (!empty(trim($_POST['ulemail'])) && filter_var(trim($_POST['ulemail']), FILTER_VALIDATE_EMAIL) == true) {
            $data['uemail'] = trim($_POST['ulemail']);

        } elseif (!empty(trim($_POST['ulemail'])) && preg_match("/^\\+?[1-9][0-9]{7,14}$/", $_POST['ulemail']) == true) {
            $data['uphone'] = trim($_POST['ulemail']);
            $phone = 1;
        } else {
            $this->error = "Please enter a valid email or phone number";
        }


        if ($this->error == '') {
            $data['upass'] = hash('sha1', $data['upass']);
            if ($_POST['chktype'] == 'User') {
                if ($phone == 1) {
                    $query = "select * from users where phone_number=:uphone and password=:upass";
                } else {
                    $query = "select * from users where email=:uemail and password=:upass";
                }
                $result = $this->db->read($query, $data);
                if (is_array($result)) {
                    $_SESSION['url_address'] = $result[0]["url_address"];
                    header("Location:" . ROOT . "home");
                } else {
                    header("Location:" . ROOT . "login?message=Invalid Credentials!!!");
                }
            } elseif ($_POST['chktype'] == 'Vendor') {
                if ($phone == 1) {
                    $query = "select * from vendors where phone_number=:uphone and password=:upass and status != 0 limit 1";
                } else {
                    $query = "select * from vendors where email=:uemail and password=:upass and status != 0 limit 1";
                }
                $result = $this->db->read($query, $data);

                if (is_array($result)) {

                    $_SESSION['url_address'] = $result[0]['url_address'];
                    $_SESSION['type'] = $result[0]['type'];
                    if ($result[0]['type'] == 1) {
                        header("Location:" . ROOT . "admin/dashboard");
                    } else {
                        header("Location:" . ROOT . "vendor/dashboard");
                    }
                } else {
                    header("Location:" . ROOT . "login?message=Invalid Credentials!!!");
                }
            }
        }

    }

    public function get_user()
    {

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

    public function check_login()
    {
        if (isset($_SESSION['url_address'])) {
            $arr["url"] = $_SESSION["url_address"];


            $sql = "select * from users where url_address=:url";

            $checklogin = $this->db->read($sql, $arr);

            if (is_array($checklogin)) {
                return json_decode(json_encode($checklogin[0]), true);
            }

        }
        return false;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location:" . ROOT . "home");
    }


}