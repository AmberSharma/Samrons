<?php
use App\Utils\BaseConstants;
require_once "BaseTrait.php";

class Admin extends controller
{
    use \App\Core\BaseTrait;

    /** @var vendormodel $vendorModel */
    private $vendorModel;

    /** @var adminmodel $adminModel */
    private $adminModel;

    public function __construct()
    {
        //$this->vendorModel = $this->load_model("vendormodel");
        $this->adminModel = $this->load_model("adminmodel");
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
        return $this->adminModel->approve_vendor($_POST["id"]);
    }
    public function reject_vendor() {
        return $this->adminModel->reject_vendor($_POST["id"]);
    }
    public function vendorList(){
//        $user=$this->load_model("user");
//        $user_data=$user->check_login();
//        if(is_array($user_data))
//        {
//            $data['user_data']=$user_data;
//        }
        $data['page_title']="Home";
        $data['vendordata']= $this->adminModel->get_vendor();
        $this->view("samrons/admin/vendorList",$data);

    }
    public function addNewCategory(){
        $data['page_title']="Add Category";
        $data['categories']=$this->vendorModel->get_categories(0);

        $this->view("samrons/admin/addCategories",$data);
    }

    public function addCategories()
    {
        $response = [];

        $this->validateFieldExists([
            BaseConstants::CATEGORY_NAME,
            BaseConstants::CATEGORY_DESCRIPTION
        ], [
            BaseConstants::CATEGORY_NAME,
            BaseConstants::CATEGORY_DESCRIPTION
        ], $_POST);

        $this->validateFieldExists([
            BaseConstants::CATEGORY_IMAGE
        ], [
            BaseConstants::CATEGORY_IMAGE
        ], $_FILES);

        $errors = $this->getError();

        if (!isset($errors[BaseConstants::CATEGORY_NAME]))
            $_POST[BaseConstants::CATEGORY_NAME] = $this->validateFormData("input", BaseConstants::CATEGORY_NAME, $_POST[BaseConstants::CATEGORY_NAME]);
        if (!isset($errors[BaseConstants::CATEGORY_DESCRIPTION]))
            $_POST[BaseConstants::CATEGORY_DESCRIPTION] = $this->validateFormData("input", BaseConstants::CATEGORY_DESCRIPTION, $_POST[BaseConstants::CATEGORY_DESCRIPTION]);
        if (!isset($errors[BaseConstants::CATEGORY_IMAGE]))
            $_FILES[BaseConstants::CATEGORY_IMAGE] = $this->validateFormData("image", BaseConstants::CATEGORY_IMAGE, $_FILES[BaseConstants::CATEGORY_IMAGE]);

        if (!empty($this->getError())) {
            $response["success"] = false;
            $response["error"] = $this->getError();
        } else {
            $response["success"] = $this->vendorModel->add_categories();
            if (!empty($response["success"])) {
                $response["message"] = "Category got added Successfully";
            } else {
                $response["error"] = "Could not add new Category";
            }
        }

        if ($_POST["source"] == "script") {
            print_r(json_encode($response, true));
        }
    }
}