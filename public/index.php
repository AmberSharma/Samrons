<?php
session_start();

$path=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/";
include "../app/init.php";
define('ROOT',$path);
define("ASSETS",$path."assets/");

$app=new App();
