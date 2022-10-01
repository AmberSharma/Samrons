<?php
class Signup extends controller {

    public function index($a="",$b=""){
        print("hello");
        $data['page_title']="Signup";
        $this->view("samrons/signup",$data);

    }
}