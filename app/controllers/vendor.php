<?php


class vendor extends controller
{
    public function addCategories(){
//        $user=$this->load_model("user");
//        $user_data=$user->check_login();
//        if(is_array($user_data))
//        {
//            $data['user_data']=$user_data;
//        }
        $data['page_title']="Home";
        $vendata = $this->load_model("vendormodel");
        //$data['categories']=$vendata->get_categories(0);

         $vendata->add_categories($_POST);
        $this->view("samrons/admin/addCategories",$data);

    }
    public function getsubcategories()
    {
        $vendata = $this->load_model("vendormodel");
        if (!empty($_POST["source"]) && $_POST["source"] == "script") {
            print_r($vendata->get_categories($_POST['parentid']));
        } else {
            $data['categories'] = $vendata->get_categories($_POST['parentid']);
            return $data;
        }
    }
    public function getoptionValues()
    {

        $vendata = $this->load_model("vendormodel");
        if (!empty($_POST["source"]) && $_POST["source"] == "script") {
            print_r($vendata->get_optionvalues($_POST['optionid']));
        }
        else {
            $data['optionvalues'] = $vendata->get_optionvalues($_POST['optionid']);
            return json_encode($data, true);
        }

    }
    public function addProductDetails()
    {
        $vendata = $this->load_model("vendormodel");
        $vendata->add_productDetails($_POST);

    }
}