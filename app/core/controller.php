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

    function getCombinations(...$arrays)
    {
        $result = [[]];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, [$property => $property_value]);
                }
            }
            $result = $tmp;
        }
        return $result;
    }
}