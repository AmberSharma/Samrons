<?php


class detail extends controller
{
    function searchByCategory($categoryId)
    {

        $vendata = $this->load_model("vendormodel");

        list($data['productdata'],
            $data['variant_ids'],
            $data['variant_options'],
            $data['images'],
            $data['quantity'],
            $data['variant_combination'])= $vendata->getProductDataForShop($categoryId,$type='detail');

        $data['page_title']="Details";


        $this->view("samrons/detail",$data);
    }
}