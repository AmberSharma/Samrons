<?php


class Logout extends controller
{
    public function index()
    {
        $User = $this->load_model("user");
        $User->logout();
    }

}