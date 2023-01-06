<?php


class cart extends controller
{
public function addToCart()
{

    if($_POST['page']=='cart')
    {
        //unset($_SESSION['variantdata']);
        $_SESSION['variantdata'][$_POST['variantId']]=$_POST['quantity'];
        $user=$this->load_model("user");

        $data['variantData']=$user->getVariantData(implode(",",array_keys($_SESSION['variantdata'])));

        $this->view("samrons/cart",$data);
    }
    else {
        //unset($_SESSION['variantdata']);
        $_SESSION['variantdata'][$_POST['variantId']] = $_POST['quantity'];

        print_r(count($_SESSION['variantdata']));
    }


  /* $user=$this->load_model("user");
    print_r(implode(",",array_column($_SESSION['variantdata'],'variantId')));

    $data['variantData']=$user->getVariantData(implode(",",array_column($_SESSION['variantdata'],'variantId')));
    print_r($data);
    $this->view("samrons/cart",$data);*/



}
public function viewCart()
{
    echo "<pre>";
    $user=$this->load_model("user");

    $data['page_title']="Add To Cart";
    if(isset($_SESSION['variantdata']) && $_SESSION['variantdata']!="") {
        $data['variantData'] = $user->getVariantData(implode(",", array_keys($_SESSION['variantdata'])));
    }
    else
        $data['variantData']="";

    echo "</pre>";
    $this->view("samrons/cart",$data);
}
public function removeFromCart()
{
    unset($_SESSION['variantdata'][$_POST['variantId']]);
}
}