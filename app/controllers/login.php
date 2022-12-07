<?php
class Login extends controller {

    public function index($a="",$b=""){

        $data['page_title']="Login";
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            //die("inside login");
            $user=$this->load_model("user");
            $user->login($_POST);
        }
        $this->view("samrons/admin/login",$data);
//        $this->view("samrons/admin/page-register", $data);

    }
}