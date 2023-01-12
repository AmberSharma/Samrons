<?php
use App\Utils\BaseConstants;
require_once 'basemodel.class.php';

class AdminModel extends basemodel
{
    private $error = "";

    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function get_vendor()
    {
        $sql = "SELECT id,
                    name,
                    email,
                    phone_number,
                    aadhar,
                    pancard,
                    gst,
                    photo,
                    signature 
                FROM vendors WHERE status=0 and type = 2";
        return $this->db->read($sql);
    }

    public function approve_vendor($id)
    {

        $data["id"]=$id;
        $sql = "update vendors set status=1 where id=:id";

        $result=$this->db->write($sql,$data);

        if (!empty($result)) {
            return json_encode($this->get_vendor(),true);
        }

        return $result;
    }
    public function reject_vendor($id)
    {

        $data["id"]=$id;
        $sql = "update vendors set status=-1 where id=:id";

        $result=$this->db->write($sql,$data);

        if (!empty($result)) {
            return json_encode($this->get_vendor(),true);
        }

        return $result;
    }



}