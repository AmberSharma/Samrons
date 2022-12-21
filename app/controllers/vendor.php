<?php

class vendor extends controller
{
    use \App\Core\BaseTrait;

    /** @var vendormodel $vendorModel */
    private $vendorModel;


    public function __construct()
    {
        $this->vendorModel = $this->load_model("vendormodel");
    }

    public function index(){

        $data['page_title']="Home";

        $this->view("samrons/admin/dashboard",$data);

    }

    public function addProducts(){
        $data['options'] = $this->getOptions();
        $data['categories'] = $this->getCategories();

        $this->view("samrons/admin/addProducts",$data);

    }

    public function getsubcategories()
    {
        if (!empty($_POST["source"]) && $_POST["source"] == "script") {
            print_r($this->vendorModel->get_categories($_POST['parentid']));
        } else {
            $data['categories'] = $this->vendorModel->get_categories($_POST['parentid']);
            return $data;
        }
    }

    public function getoptionValues()
    {
        if (!empty($_POST["source"]) && $_POST["source"] == "script") {
            print_r($this->vendorModel->get_optionvalues($_POST['optionid']));
        } else {
            $data['optionvalues'] = $this->vendorModel->get_optionvalues($_POST['optionid']);
            return json_encode($data, true);
        }

    }

    public function addProductDetails()
    {
        $this->vendorModel->add_productDetails();
    }

    public function addBulkProducts()
    {
        $this->vendorModel->add_bulkProductDetails();
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