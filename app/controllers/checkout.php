<?php


class checkout extends controller
{
public function index()
{

    if(!isset($_SESSION['url_address']))
    {
        header("Location:" . ROOT . "login?message=Please Login To Proceed!!!");
    }
    else
    {
        /*$user=$this->load_model("user");
        $id=$user->addAdress($_POST);*/
//        if($_POST['add_line_1']!="")
//            $data['id']=$this->addAddress();

//        foreach ($_POST as $key => $value) {
//            $_POST[$key] = NULL;
//        }
        $data['page_title']="Check Out";
        $user=$this->load_model("user");
        $data['addressdetails']=$user->getAddresses($_SESSION['url_address']);
        if(isset($_SESSION['variantdata']) && $_SESSION['variantdata']!="") {
            $data['variantData'] = $user->getVariantData(implode(",", array_keys($_SESSION['variantdata'])));
            //$data['combinationValue']=$user->getColorAndSize(implode(",", array_keys($_SESSION['variantdata'])));
        }

        $this->view("samrons/checkout",$data);
    }


}
public function addAddress()
{
    print_r($_POST);
    $user=$this->load_model("user");
          $id=$user->addAdress($_POST);
    unset($_POST);

    header("Location:" . ROOT . "checkout");

}
    public function saveorder()
    {
        $orderdata=array();
        $orderdata['addressId']=$_POST['addresses'];
        $orderdata['variantIds']=implode(",", array_keys($_SESSION['variantdata']));
        $user=$this->load_model("user");
        $id=$user->saveOrder($orderdata);
        print_r($id);
        print_r($_SESSION['variantdata']);
        //header("Location:" . ROOT . "checkout");

    }
}