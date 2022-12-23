<?php

class Database
{

    public static $conn;

    function __construct()
    {
        try {
            $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            self::$conn = new PDO($string, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function getInstance()
    {
        if (self::$conn) {
            return self::$conn;
        }

        return $instance = new self();

    }

    public function read($query, $data = [])
    {
        $stm = self::$conn->prepare($query);

        $result = $stm->execute($data);
        if ($result) {
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($data) && !empty($data)) {
                return $data;
            }
        }
        return false;
    }

    public function write($query, $data = [])
    {
        //print_r($data);die("dsfds");
        $stm = self::$conn->prepare($query);
        $stm->execute($data);
        if (self::$conn->lastInsertId() != "") {
            return self::$conn->lastInsertId();
        }
        return false;
    }

}


