<?php

class Database
{
    protected static $conn = null;

    function __construct()
    {
        try {
            $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            self::$conn = new PDO($string, DB_USER, DB_PASS);
            //self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$conn;
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function getInstance()
    {
        if (self::$conn == null) {
            return new self();
        }

        return self::$conn;
    }

    public function read($query, $data = [])
    {
        $stm = self::$conn->prepare($query);
        $result = $stm->execute($data);
        //$stm->debugDumpParams();die("Fdsfsd");
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
        $stm = self::$conn->prepare($query);
        $stm->execute($data);

        //$stm->debugDumpParams();die("Fdsfsd");
        if (self::$conn->lastInsertId() != "") {
            return self::$conn->lastInsertId();
        }
        return false;
    }

}


