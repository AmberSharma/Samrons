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

    public function validateFieldExists($fields, $data) {
        foreach($fields as $fieldName) {
            if(!isset($data[$fieldName])) {
                $this->setError($fieldName, "Cannot be empty");
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
                if (ctype_digit($this->data)) {
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
                if (preg_match('/^[0-9]{10}+$/', $this->data)) {
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