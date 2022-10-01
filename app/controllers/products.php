<?php
class Products extends controller {
    function index()
    {
        $data['page_title']="Products";
        $this->view("samrons/index",$data);
    }
}