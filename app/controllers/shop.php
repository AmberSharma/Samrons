<?php

use http\Params;

class shop extends controller {
    function searchByCategory($categoryId)
    {

        $vendata = $this->load_model("vendormodel");
      $categoriesIds=implode(",",$vendata->getChildren($categoryId, [$categoryId]));
        $data['productdata']= $vendata->getProductDataForShop($categoriesIds);

        $data['page_title']="Shop";

        $this->view("samrons/shop",$data);
    }
}