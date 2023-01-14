<?php

use http\Params;

class shop extends controller {

    /** @var User $userModel */
    private $userModel;

    /** @var vendormodel $vendorModel */
    private $vendorModel;

    public function __construct()
    {
        $this->userModel = $this->load_model("user");
        $this->vendorModel = $this->load_model("vendormodel");
    }

    function index() {
        header("Location:" . ROOT . "home");
    }

    function searchByCategory($categoryId)
    {
        $data["category_subcategory"] = $this->userModel->get_category_subcategory_data();
        $categoriesIds=implode('","',$this->vendorModel->getChildren($categoryId, [$categoryId]));
        $data['productdata']= $this->vendorModel->getProductDataForShop($categoriesIds,$type='shop');

        $data['page_title']="Shop";


        $this->view("samrons/shop",$data);
    }
    public function searchProducts()
    {
        print_r($_POST);
        $vendata = $this->load_model("vendormodel");

        $data['productdata']= $vendata->searchProducts($_POST['searchtext']);

        $data['page_title']="Shop";

        print_r($data);
        $this->view("samrons/shop",$data);
    }

}