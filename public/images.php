<?php

$IMG_DIR = '../app/uploads/'; //put all protected images here

$img = $_GET["filename"]; //the file's name, matches the f= parameter in <img>

$img_path = $IMG_DIR."/$img";
if(!is_file($img_path)){ // make sure this image exists
    http_response_code(404); //404 not found error
    exit;
}

$extension = pathinfo($img,PATHINFO_EXTENSION); //eg: "png"
$mimetype = "image/$extension"; //type of image. browser needs this info
$size = filesize($img_path);

//tell the browser what to expect
header("Content-Type: $mimetype");
header("Content-Length: $size");

//send the file to the browser
readfile($img_path);