<?php
class Home extends controller {

    public function index(){
        $user=$this->load_model("user");
        $user_data=$user->check_login();

        //$data['categories']=$vendata->get_categories(0);

        $categoryData=$user->get_categories(0);



        if(is_array($user_data))
        {
            $data['user_data']=$user_data;
        }
        $data['page_title']="Home";
        $data['parentCategoryData']=json_decode($categoryData,true);
        $this->view("samrons/index",$data);

    }
}