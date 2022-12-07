<?php
class Signup extends controller {


    public function index(){

        $data['page_title']="Signup";

        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $user=$this->load_model("user");
            $user->sign_up($_POST);
        }
        $this->view("samrons/admin/register",$data);

    }

    public function check_email() {
        $user=$this->load_model("user");
        echo $user->check_email($_POST["uemail"],$_POST["usertype"]);
    }

    public function check_pass() {
        $user=$this->load_model("user");
        echo $user->check_pass($_POST["upass"]);
    }
    public function check_phone() {
        $user=$this->load_model("user");
        echo $user->check_phone($_POST["uphone"],$_POST["usertype"]);
    }

}