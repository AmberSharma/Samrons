<?php

class controller
{
    function view($path,$data=[])
    {

        if("../app/views/".$path.".php")
        {

            include "../app/views/".$path.".php";
        }
    }
}