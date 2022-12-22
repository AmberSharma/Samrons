<?php
use App\Utils\BaseConstants;
require_once getcwd()."/../app/controllers/BaseTrait.php";

class controller
{
    use \App\Core\BaseTrait;

    function view($path,$data =[])
    {

        if(file_exists("../app/views/".$path.".php"))
        {
            include "../app/views/".$path.".php";
        }
    }
    function load_model($model)
    {

        if(file_exists("../app/models/".$model.".class.php"))
        {
            include_once "../app/models/".$model.".class.php";
            return $m = new $model();
        }
        return false;
    }
}