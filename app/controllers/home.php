<?php
class Home extends controller {

    public function index($a="",$b=""){
        
        $data['page_title']="Home";
        $this->view("samrons/index",$data);

    }
}