<?php
namespace App\Core;

trait BaseTrait
{
    private $data;
    private $maxSize = 1048576; // 1 MB = 1048576 bytes, 2 MB = 2097152
    private $acceptableImg = [
        'image/jpeg',
        'image/jpg',
        'image/png'
    ];
    private $error = [];

    public function validateFieldExists($fields, $fieldNames, $data) {
        foreach($fields as $key => $fieldFormName) {
            if(!isset($data[$fieldFormName])) {
                $this->setError($fieldNames[0], "Cannot be empty");
            }
        }
    }
    public function validateFormData($type, $fieldName, $data) {
        switch ($type) {
            case "input":
                $this->data = trim($data);
                if (empty($this->data)) {
                    $this->setError($fieldName, "Cannot be empty");
                }
                $this->data = filter_var($this->data, FILTER_SANITIZE_STRING);
                break;
            case "number":
                $this->data = trim($data);
                if (!ctype_digit($this->data)) {
                    $this->setError($fieldName, "Should be an Integer");
                }
                $this->data = filter_var($this->data, FILTER_SANITIZE_NUMBER_INT);
                break;
            case "image":
                $this->data = $data;
                if (isset($this->data['type']) && !in_array($this->data['type'], $this->acceptableImg)) {
                    $this->setError($fieldName, "Only jpg/Jpeg/png accepted");
                }
                else if (isset($this->data['size']) && $data['size'] >= $this->maxSize) {
                    $this->setError($fieldName, "Image Size more than 1 MB");
                }
                break;
            case "phone":
                $this->data = trim($data);
                if (!preg_match('/^[0-9]{10}+$/', $this->data)) {
                    $this->setError($fieldName, "Invalid Phone Number");
                }
                break;
            case "email":
                $this->data = trim($data);
                if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $this->data)) {
                    $this->setError($fieldName, "Invalid Email Address");
                }
                $this->data = filter_var($this->data, FILTER_SANITIZE_EMAIL);
                break;
            case "password":
                $this->data = trim($data);
                if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $this->data)) {
                    $this->setError($fieldName, "Invalid Password");
                }
                break;
            case "aadhar":
                $this->data = trim($data);
                if (!preg_match("/^[2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}$/", $this->data)) {
                    $this->setError($fieldName, "Invalid Aadhar");
                }
                break;
            case "gst":
                $this->data = trim($data);
                if (!preg_match("/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/", $this->data)) {
                    $this->setError($fieldName, "Invalid GST");
                }
                break;
            case "pancard":
                $this->data = trim($data);
                if (!preg_match("/^[A-Z]{5}\d{4}[A-Z]{1}$/", $this->data)) {
                    $this->setError($fieldName, "Invalid GST");
                }
                break;
            case "uuid":
                $this->data = trim($data);
                if(strlen($this->data) != 36) {
                    $this->setError($fieldName, "Should be system compatible Id".strlen($this->data));
                }
                break;
        }

        return $this->data;
    }

    private function setError($fieldName, $message) {
        $this->error[$fieldName][] = $message;
    }

    public function getError() {
        return $this->error;
    }
}