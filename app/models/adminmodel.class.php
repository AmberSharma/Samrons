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

    public function get_dashboardData() {
        $dashboardData = [];
        $activeVendorSql = "SELECT count(1) as count from vendors where status = 1 and type = 2";
        $result = $this->db->read($activeVendorSql);
        $dashboardData["header"][] = [
            "name" => "Active Vendors",
            "count" => $result[0]["count"],
            "icon" => "pe-7s-users"
        ];

        $activeVendorSql = "SELECT count(1) as count from vendors where status = 0 and type = 2";
        $result = $this->db->read($activeVendorSql);
        $dashboardData["header"][] = [
            "name" => "Inactive Vendors",
            "count" => $result[0]["count"],
            "icon" => "pe-7s-user"
        ];

        $activeVendorSql = "SELECT count(1) as count from users";
        $result = $this->db->read($activeVendorSql);
        $dashboardData["header"][] = [
            "name" => "Total Users",
            "count" => $result[0]["count"],
            "icon" => "pe-7s-users"
        ];

        $data["start"] = date('Y-m-01');
        $data["end"] = date('Y-m-t');

        $activeVendorSql = "SELECT count(1) as count from orders WHERE timestamps between :start AND :end";
        $result = $this->db->read($activeVendorSql, $data);
        $dashboardData["header"][] = [
            "name" => "Month Orders",
            "count" => $result[0]["count"],
            "icon" => "pe-7s-cart"
        ];

        $activeVendorSql = "SELECT oi.*, o.status FROM order_items oi INNER JOIN orders o on o.id = oi.order_id";
        $result = $this->db->read($activeVendorSql, $data);
        $dashboardData["orders"] = $result;

        return $dashboardData;
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
                    signature,
                    auto_id,
                    cheque
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