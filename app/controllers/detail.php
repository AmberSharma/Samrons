<?php


class detail extends controller
{
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

        list($data['productdata'],
            $data['variant_ids'],
            $data['variant_options'],
            $data['images'],
            $data['quantity'],
            $data['variant_combination'],
            $data['variant_auto_id'])= $this->vendorModel->getProductDataForShop($categoryId,$type='detail');

        $data['page_title']="Details";

        $this->view("samrons/detail",$data);
    }
}