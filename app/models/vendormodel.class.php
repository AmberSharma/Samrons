<?php


class vendormodel
{
    public function add_categories()
    {
        $data = array();
        $_POST = array_map('trim', $_POST);

        $data['cname']  = $_POST['cname'];
        $data['desc']   = $_POST['desc'];
        $data['parentcat']   = $_POST['parentcat'];

        $db=Database::getInstance();
        $query="insert into categories(parent_id,name,description) values (:parentcat,:cname,:desc)";
        $result=$db->write($query,$data);


        if(is_array($result)){
            $message = "You are Successfully Registered. Try Login after couple of hours after Admin Approval";
        }
    }

    public function get_categories($parentid)
    {
        $data['parent_id']=$parentid;
        $db=Database::getInstance();
        $sql="select id,parent_id,name from categories where parent_id=:parent_id";
        $categories = $db->read($sql, $data);
        if (is_array($categories) )
        {
            return json_encode($categories, true);
        }
    }
}