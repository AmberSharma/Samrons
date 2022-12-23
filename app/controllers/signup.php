<?php
use App\Utils\BaseConstants;

class Signup extends controller {

    public function index(){

        $data['page_title']="Signup";

        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $this->validateFieldExists([
                BaseConstants::UNAME,
                BaseConstants::UEMAIL,
                BaseConstants::UPASS,
                BaseConstants::UPHONE
            ],[
                BaseConstants::NAME,
                BaseConstants::EMAIL,
                BaseConstants::PASSWORD,
                BaseConstants::PHONE
            ], $_POST);

            $errors = $this->getError();

            if (!isset($errors[BaseConstants::NAME]))
                $_POST[BaseConstants::UNAME] = $this->validateFormData("input", BaseConstants::NAME, $_POST[BaseConstants::UNAME]);
            if (!isset($errors[BaseConstants::EMAIL]))
                $_POST[BaseConstants::UEMAIL] = $this->validateFormData("email", BaseConstants::EMAIL, $_POST[BaseConstants::UEMAIL]);
            if (!isset($errors[BaseConstants::PASSWORD]))
                $_POST[BaseConstants::UPASS] = $this->validateFormData("password", BaseConstants::PASSWORD, $_POST[BaseConstants::UPASS]);
            if (!isset($errors[BaseConstants::PHONE]))
                $_POST[BaseConstants::UPHONE] = $this->validateFormData("phone", BaseConstants::PHONE, $_POST[BaseConstants::UPHONE]);

            if(!empty($_POST["chktype"]) && $_POST["chktype"] == "Vendor") {
                $this->validateFieldExists([
                    BaseConstants::AADHAR,
                    BaseConstants::PANCARD,
                    BaseConstants::GST,
                    BaseConstants::CACCOUNT
                ], [
                    BaseConstants::AADHAR,
                    BaseConstants::PANCARD,
                    BaseConstants::GST,
                    BaseConstants::CURRENT_ACCOUNT
                ], $_POST);

                $this->validateFieldExists([
                    BaseConstants::CANCELCHEQUE,
                    BaseConstants::PHOTO,
                    BaseConstants::SIGN
                ],[
                    BaseConstants::CHEQUE,
                    BaseConstants::PHOTO,
                    BaseConstants::SIGN
                ], $_FILES);
            }

            $errors = $this->getError();

            if (!isset($errors[BaseConstants::AADHAR]))
                $_POST[BaseConstants::AADHAR] = $this->validateFormData("aadhar", BaseConstants::AADHAR, $_POST[BaseConstants::AADHAR]);
            if (!isset($errors[BaseConstants::GST]))
                $_POST[BaseConstants::GST] = $this->validateFormData("gst", BaseConstants::GST, $_POST[BaseConstants::GST]);
            if (!isset($errors[BaseConstants::PANCARD]))
                $_POST[BaseConstants::PANCARD] = $this->validateFormData("pancard", BaseConstants::PANCARD, $_POST[BaseConstants::PANCARD]);
//            if (!isset($errors[BaseConstants::CACCOUNT]))
//                $_POST[BaseConstants::CACCOUNT] = $this->validateFormData("number", BaseConstants::CACCOUNT, $_POST[BaseConstants::CACCOUNT]);

            if (!isset($errors[BaseConstants::CANCELCHEQUE]))
                $_FILES[BaseConstants::CANCELCHEQUE] = $this->validateFormData("image", BaseConstants::CANCELCHEQUE, $_FILES[BaseConstants::CANCELCHEQUE]);
            if (!isset($errors[BaseConstants::PHOTO]))
                $_FILES[BaseConstants::PHOTO] = $this->validateFormData("image", BaseConstants::PHOTO, $_FILES[BaseConstants::PHOTO]);
            if (!isset($errors[BaseConstants::SIGN]))
                $_FILES[BaseConstants::SIGN] = $this->validateFormData("image", BaseConstants::SIGN, $_FILES[BaseConstants::SIGN]);

            if (empty($this->getError())) {
                $user = $this->load_model("user");
                $user->sign_up();
            } else {
                $data["errors"] = $this->getError();
            }
        }
        $this->view("samrons/admin/register",$data);

    }

    public function check_email() {
        $user=$this->load_model("user");
        echo $user->check_email($_POST["uemail"],$_POST["usertype"]);
    }

    public function check_pass() {
        $user=$this->load_model("user");
        echo $user->check_pass($_POST["upass"]);
    }
    public function check_phone() {
        $user=$this->load_model("user");
        echo $user->check_phone($_POST["uphone"],$_POST["usertype"]);
    }

}