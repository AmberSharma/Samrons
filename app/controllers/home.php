<?php
class Home extends controller {

    public function index($a="",$b=""){
        echo $a;
        echo $b;

        $this->view("home");

    }
}