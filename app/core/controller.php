<?php

class controller
{
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