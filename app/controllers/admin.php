<?php
class Admin extends controller {

    /** @var vendormodel $vendorModel */
    private $vendorModel;
    private $adminModel;

    public function __construct()
    {
        $this->vendorModel = $this->load_model("vendormodel");
    }

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
        //$vendata = $this->load_model("vendormodel");
        $data['categories']=$this->vendorModel->get_categories(0);


        $this->view("samrons/admin/addCategories",$data);

    }
    public function addProduts(){
//        $user=$this->load_model("user");
//        $user_data=$user->check_login();
//        if(is_array($user_data))
//        {
//            $data['user_data']=$user_data;
//        }
        $data['page_title']="Home";
        $data['options']=$this->getOptions();
        $data['categories']=$this->getCategories();

        $this->view("samrons/admin/addProducts",$data);

    }

    public function getOptions() {
        if (isset($_POST["source"]) && $_POST["source"] == "script") {
            print_r($this->vendorModel->get_options());
        } else {
            return $this->vendorModel->get_options();
        }
    }

    public function getCategories() {
        $parentId = 0;

        if(!empty($_POST["parentid"])) {
            $parentId = $_POST["parentid"];
        }
        if (isset($_POST["source"]) && $_POST["source"] == "script") {
            print_r($this->vendorModel->get_categories($parentId));
        } else {
            return $this->vendorModel->get_categories($parentId);
        }
    }
}