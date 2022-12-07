<?php
use App\Utils\BaseConstants;

class AdminModel
{
    private $error = "";



    public function get_vendor()
    {
        $db = Database::getInstance();
        $sql = "select id, username,email,phone_number,aadhar,pancard,gst,photo,signature from vendors where status=0";
        $vendordata = $db->read($sql);

        return $vendordata;
    }
    public function approve_vendor($id)
    {
        $db = Database::getInstance();
        $data["id"]=$id;
        $sql = "update vendors set status=1 where id=:id";

        $result=$db->write($sql,$data);

        if (!empty($result)) {
            return json_encode($this->get_vendor(),true);
        }

        return $result;
    }
    public function reject_vendor($id)
    {
        $db = Database::getInstance();
        $data["id"]=$id;
        $sql = "update vendors set status=-1 where id=:id";

        $result=$db->write($sql,$data);

        if (!empty($result)) {
            return json_encode($this->get_vendor(),true);
        }

        return $result;
    }



}