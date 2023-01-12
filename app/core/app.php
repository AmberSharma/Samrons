<?php

class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params;
    const CONTROLLER_PATH="../app/controllers/";

    public function __construct()
    {

        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $url = $this->parseURL();
        if (file_exists(self::CONTROLLER_PATH . strtolower($url[0]) . ".php")) {

            $this->controller = strtolower($url[0]);

            unset($url[0]);
        }

        if(isset($_SESSION['type']) && $_SESSION['type'] == 2 && strtolower($this->controller)!="vendor")
        {
            header("Location:/vendor/dashboard");
        }
        elseif (isset($_SESSION['type']) && $_SESSION['type']==1 && strtolower($this->controller)!="admin")
        {
            header("Location:/admin/dashboard");
        }
        elseif(!isset($_SESSION)||(isset($_SESSION)&&!isset($_SESSION['type'])))
        {
            if($this->controller=="vendor" || $this->controller=="admin") {
                header("Location:" . ROOT . "home");
            }
        }

        require self::CONTROLLER_PATH . $this->controller . ".php";

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, strtolower($url[1]))) {
                $this->method = strtolower($url[1]);
                unset($url[1]);
            }
        }
        
        $this->params = (count($url) > 0 ? array_values($url) : ["home"]);

        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";

        return explode("/", filter_var(trim($url, "/")), FILTER_SANITIZE_URL);
    }
}