<?php
class Login extends controller {

    public function index($a="",$b=""){
print("hello");
        $data['page_title']="Login";
        $this->view("samrons/login",$data);

    }
}