<?php
class Admin extends controller {

    public function index(){
//        $user=$this->load_model("user");
//        $user_data=$user->check_login();
//        if(is_array($user_data))
//        {
//            $data['user_data']=$user_data;
//        }
        $data['page_title']="Home";

        $this->view("samrons/admin/dashboard",$data);

    }
    public function approve_vendor() {
        $admin=$this->load_model("adminmodel");
        return $admin->approve_vendor($_POST["id"]);
    }
    public function reject_vendor() {
        $admin=$this->load_model("adminmodel");
        return $admin->reject_vendor($_POST["id"]);
    }
    public function datatable(){
//        $user=$this->load_model("user");
//        $user_data=$user->check_login();
//        if(is_array($user_data))
//        {
//            $data['user_data']=$user_data;
//        }
        $data['page_title']="Home";
        $vendata = $this->load_model("adminmodel");
        $data['vendordata']= $vendata->get_vendor();
        $this->view("samrons/admin/datatable",$data);

    }
    public function addCategories(){
//        $user=$this->load_model("user");
//        $user_data=$user->check_login();
//        if(is_array($user_data))
//        {
//            $data['user_data']=$user_data;
//        }
        $data['page_title']="Home";
        /*$vendata = $this->load_model("adminmodel");
        $data['vendordata']= $vendata->get_vendor();*/
        $vendata = $this->load_model("vendormodel");
        $data['categories']=$vendata->get_categories(0);


        $this->view("samrons/admin/addCategories",$data);

    }
}