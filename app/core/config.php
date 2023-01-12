<?php
define("WEBSITE_TITLE",'SAMRONS');
define("DB_NAME",'samrons');
define("DB_USER","root");
define("DB_PASS","root");
define("DB_TYPE","mysql");
define("DB_HOST","localhost");
define("DEBUG",true);
if(DEBUG){
    define("CF_URL", "https://sandbox.cashfree.com/pg");
    define("CF_API_KEY", "293672a5e3fb4d6048c591579c276392");
    define("CF_API_SECRET", "TEST866999efc1eb0e6a77d5986b8ed20f30cef033b0");
    ini_set("display_errors",1);
}
else{
    define("CF_URL", "https://sandbox.cashfree.com/pg");
    define("CF_API_KEY", "293672a5e3fb4d6048c591579c276392");
    define("CF_API_SECRET", "TEST866999efc1eb0e6a77d5986b8ed20f30cef033b0");
    ini_set("display_errors",0);
}