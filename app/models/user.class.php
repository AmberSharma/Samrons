<?php
use App\Utils\BaseConstants;

class User
{
    private $db;

    public function  __construct() {
        $this->db = Database::getInstance();
    }
    private $error = "";
    public function get_categories($parentid)
    {
        $data['parent_id']=$parentid;
        //$db=Database::getInstance();
        $sql="select id,parent_id,name,category_image from categories where parent_id=:parent_id";
        $categories = $this->db->read($sql, $data);
        if (is_array($categories) )
        {
            return json_encode($categories, true);
        }
    }
    public function sign_up()
    {

        $data = array();
        $_POST = array_map('trim', $_POST);
        $data['uemail']  = $_POST['uemail'];
        $data['uname']   = $_POST['uname'];
        $data['upass']   = $_POST['upass'];
        $data['uphone']  = $_POST['uphone'];

        if (empty($data['uname']) || preg_match('/^[a-zA-Z0-9]{5,30}+$/', $data['uname']) == false) {
            $this->error .= "name is not valid <br>";
        }
        if (empty($data['upass']) || preg_match('/ ^(?=.*[^a-zA-Z]).{8,40}$/', $data['upass']) == false) {
            $this->error .= "The password is invalid 
                            - At least 8 digits in length.
                            - no more than 40 characters in length.
                            - Must contain at least 1 special character or number.<br>";
        }
        if (empty($data['uemail']) || filter_var($data['uemail'], FILTER_VALIDATE_EMAIL) == false) {
            $this->error .= "email is not valid <br>";
        }
        if ($data['upass'] != $_POST["upass2"]) {
            $this->error .= "Password do not match<br>";

        }

/*$sql="select * from users where email=:email limit 1";
$arr['email']= $data['uemail'];
        $check=$db->read($sql,$arr);

        if(is_array($check))
        {
             $this->error.="This email is already registered";

        }*/
        if (!empty($this->error)) {
            $data['url_address'] = $this->generateRandomString();
            $data['date'] = date('y-m-d H:i:s');
            $data['upass']=hash('sha1',$data['upass']);

            if($_POST['chktype']=='Vendor')
            {
                $data['aadhar']=$_POST['aadhar'];
                $data['pancard']=$_POST['pancard'];
                $data['gst']=$_POST['gst'];
                $data['caccountnumber']=$_POST['caccountnumber'];
                $data['cancelcheque']=$this->generateRandomString();
                $data['photo']=$this->generateRandomString();
                $data['sign']=$this->generateRandomString();

                $query = "INSERT INTO ".BaseConstants::VENDOR_TABLE." (
                    url_address,
                    create_datetime,
                    username,
                    email,
                    password,
                    phone_number,
                    aadhar,
                    pancard,
                    gst,
                    cheque,
                    photo,
                    signature,
                    current_account_number) 
                values (
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
                    :caccountnumber)";
               $result=$this->db->write($query,$data);

               if (!file_exists(FILEUPLOAD.$result)) {
                   $dir_path=getcwd()."/../app/uploads/";
                   mkdir(getcwd(). "/../app/uploads/".$result,0777, true);

                   $info=pathinfo($_FILES["cancelcheque"]["name"]);
                   $ext=$info["extension"];
                   $filename=$data['cancelcheque'].".".$ext;


                   $target_dir = $dir_path.$result."/".$filename;
                   move_uploaded_file($_FILES["cancelcheque"]["tmp_name"], $target_dir);

                   $info=pathinfo($_FILES["photo"]["name"]);
                   $ext=$info["extension"];
                   $filename=$data['photo'].".".$ext;


                   $target_dir = $dir_path.$result."/".$filename;
                   move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir);

                   $info=pathinfo($_FILES["sign"]["name"]);
                   $ext=$info["extension"];
                   $filename=$data['sign'].".".$ext;


                   $target_dir = $dir_path.$result."/".$filename;
                   move_uploaded_file($_FILES["sign"]["tmp_name"], $target_dir);

                   chmod(getcwd(). "/../app/uploads/".$result, 0777);

                   $uploadOk = 1;

               }
               if(is_array($result)){
                   $message = "You are Successfully Registered. Try Login after couple of hours after Admin Approval";
                   header("Location:".ROOT."signup?message={$message}");
               }
           }
           else {
               $query = "INSERT INTO users (
                        url_address,
                        create_datetime,
                        username,
                        email,
                        password,
                        phone_number ) 
                    values (
                        :url_address,
                        :date,
                        :uname,
                        :uemail,
                        :upass,
                        :uphone )";

               $result=$this->db->write($query,$data);
               if(!empty($result)){
                   $message = "You are Successfully Registered. Please Proceed to Login";
                   header("Location:".ROOT."signup?message={$message}");
               }
           }
        }
        $_SESSION['error']=$this->error;
    }


    public function check_email($email,$usertype) {
        if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            return "Email is not in valid format";
        }
        else {

            if($usertype=="User") {
                $sql = "select count(1) as count from users where email=:uemail";
            }
            else{
                $sql = "select count(1) as count from vendors where email=:uemail";
            }
            $arr['uemail'] = $email;
            $checkIfEmailExists = $this->db->read($sql, $arr);
            if (is_array($checkIfEmailExists) && $checkIfEmailExists[0]->count != 0) {
                return "This email is already registered";
            }
        }

    }
    public function check_phone($phone,$usertype) {
        if(preg_match("/^\\+?[1-9][0-9]{7,14}$/", $phone)==false) {
            return "Phone Number is not valid";
        }
        else {

            if($usertype=="User") {
                $sql = "select count(1) as count from users where phone_number=:uphone";
            }
            else
            {
                $sql = "select count(1) as count from vendors where phone_number=:uphone";
            }
            $arr['uphone'] = $phone;
            $checkIfPhoneExists = $this->db->read($sql, $arr);
            if (is_array($checkIfPhoneExists) && $checkIfPhoneExists[0]->count != 0) {
                return "This Phone Number is already registered";
            }
        }

    }

    public function check_pass($pass)
    {
        if (empty($pass) || preg_match( "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $pass) == false)
        {
            return "Password must contain<br/>- Minimum eight characters<br/>- Atleast one letter<br/>- One number and one special character";
        }

        return  "";
    }


    public function login()
    {

        $data = array();
        $phone=0;

        $data['upass']= trim($_POST['ulpass']);


        if (!empty(trim($_POST['ulemail'])) && filter_var(trim($_POST['ulemail']), FILTER_VALIDATE_EMAIL) == true) {
            $data['uemail'] = trim($_POST['ulemail']);

        }
        elseif (!empty(trim($_POST['ulemail']))&&preg_match("/^\\+?[1-9][0-9]{7,14}$/", $_POST['ulemail'])==true)
        {
            $data['uphone']=trim($_POST['ulemail']);
            $phone=1;
        }
        else {
            $this->error = "plese enter a valid email or phone number";
        }


        if ($this->error =='') {


            $data['upass']=hash('sha1',$data['upass']);
            if($_POST['chktype']=='User'){
            if($phone==1)
            {

                $query = "select * from users where phone_number=:uphone and password=:upass";
            }
            else {

                $query = "select * from users where email=:uemail and password=:upass";
            }
            $result=$this->db->read($query,$data);
            if(is_array($result)){
                $_SESSION['url_address']=$result[0]["url_address"];
                print_r( $_SESSION['url_address']);
                header("Location:".ROOT."home");
            }
            else{
                print_r("invalid credentials");
                $this->error="invalid credentials";
            }

        }
        elseif ($_POST['chktype']=='Vendor'){



            if($phone==1)
            {

                $query = "select * from vendors where phone_number=:uphone and password=:upass";
            }
            else {
                print_r("Vendor");
                $query = "select * from vendors where email=:uemail and password=:upass";
            }
            $result=$this->db->read($query,$data);
            print_r($result);
            if(is_array($result)){
                $_SESSION['url_address']=$result[0][url_address];
                print_r( $_SESSION['url_address']);

                header("Location:".ROOT."admin/dashboard");
            }
            else{
                print_r("invalid credentials");
                $this->error="invalid credentials";
            }

        }


        }


        $_SESSION['error']=$this->error;


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
        if(isset($_SESSION['url_address']))
        {
            $arr["url"]=$_SESSION["url_address"];


            $sql = "select * from users where url_address=:url";

            $checklogin = $this->db->read($sql, $arr);

            if (is_array($checklogin) ) {
                return json_decode(json_encode($checklogin[0]), true);
            }

        }
        return false;
    }
    public function logout()
    {
        if(isset($_SESSION["url_address"])){
            unset($_SESSION["url_address"]);
        }
        header("Location:".ROOT."home");
    }


}