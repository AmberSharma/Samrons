<?php


class cart extends controller
{
    public function checkMinQuantity()
    {

        $user=$this->load_model("user");
        $res=$user->checkMinQuantity($_POST);
        print_r($res);
    }

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
    $user=$this->load_model("user");
    $data['page_title']="Add To Cart";
    $data["category_subcategory"] = $user->get_category_subcategory_data();
    if(isset($_SESSION['variantdata']) && !empty($_SESSION['variantdata'])) {
        $data['variantData'] = $user->getVariantData(implode('","', array_keys($_SESSION['variantdata'])));
    }
    else
        $data['variantData']="";

    $this->view("samrons/cart",$data);
}
public function removeFromCart()
{
    unset($_SESSION['variantdata'][$_POST['variantId']]);
}

}