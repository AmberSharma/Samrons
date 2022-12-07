<?php
session_start();

$path=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/";
/*echo "<pre>";print_r($_SERVER);
die($path);*/
include "../app/init.php";
//define(("VIEWS",))
define('ROOT',$path);
define('DOC_ROOT', "/var/www/html/Samrons/public_html");
define('APP_ROOT', "../app/");
define("ASSETS",$path."assets/");
define("FILEUPLOAD",$path."upload/");
define("THEME", "samrons/");

$app=new App();
