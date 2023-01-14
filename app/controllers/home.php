<?php
class Home extends controller {

    /** @var User $userModel */
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->load_model("user");
    }

    public function index(){
        $data['parentCategoryData']= json_decode($this->userModel->get_categories(0), true);
        $data["category_subcategory"] = $this->userModel->get_category_subcategory_data();

        $data['page_title']="Home";
        $this->view("samrons/index",$data);

    }
}