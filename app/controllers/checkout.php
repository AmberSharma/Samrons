<?php


class checkout extends controller
{
public function index()
{
    print_r($_POST);
    if(!isset($_SESSION['url_address']))
    {
        header("Location:" . ROOT . "login?message=Please Login To Proceed!!!");
    }
    else
    {
        $data['page_title']="Check Out";
        $this->view("samrons/checkout",$data);
    }


}
}