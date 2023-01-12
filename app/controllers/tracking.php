<?php


class tracking extends controller
{
public function index()
{
    unset($_SESSION['variantdata']);
    $data['page_title']="Tracking";
    $this->view("samrons/tracking", $data);
}
}