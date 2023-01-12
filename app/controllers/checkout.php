<?php
use App\Utils\CurlRequest;
use Ramsey\Uuid\Uuid;

class checkout extends controller
{
    public function index()
    {
        if (!isset($_SESSION['url_address'])) {
            header("Location:" . ROOT . "login?message=Please Login To Proceed!!!");
        } else {
            /*$user=$this->load_model("user");
            $id=$user->addAdress($_POST);*/
//        if($_POST['add_line_1']!="")
//            $data['id']=$this->addAddress();

//        foreach ($_POST as $key => $value) {
//            $_POST[$key] = NULL;
//        }
            $data['page_title'] = "Check Out";
            $user = $this->load_model("user");
            $data['addressdetails'] = $user->getAddresses($_SESSION['url_address']);
            if (isset($_SESSION['variantdata']) && $_SESSION['variantdata'] != "") {
                $data['variantData'] = $user->getVariantData(implode('","', array_keys($_SESSION['variantdata'])));

                //$data['combinationValue']=$user->getColorAndSize(implode(",", array_keys($_SESSION['variantdata'])));
            }

            $this->view("samrons/checkout", $data);
        }


    }

    public function addAddress()
    {
        print_r($_POST);
        $user = $this->load_model("user");
        $id = $user->addAdress($_POST);
        unset($_POST);

        header("Location:" . ROOT . "checkout");

    }

    public function saveorder()
    {

        if(isset($_POST['callFrom']) && $_POST['callFrom']=="userjs") {
            $_SESSION['addressId']=$_POST['addresses'];
            $user = $this->load_model("user");
            $curlData = $user->savePayment();
            print_r($curlData);
        }
        else {
            echo "<pre>";
            $response=CurlRequest::get(CF_URL . "/orders/" . $_REQUEST["order_id"]);
            $_SESSION['response']=$response;

            $orderdata = array();
            $orderdata['order_id'] = $response["order_id"];
            $orderdata['status'] = $response["order_status"];
            $orderdata['addressId'] = $_SESSION['addressId'];
            $orderdata['variantIds'] = implode(",", array_keys($_SESSION['variantdata']));
            $user = $this->load_model("user");
            $id = $user->saveOrder($orderdata);
            header("Location:" . ROOT . "tracking");

        }

//        die("dfsdfds");
        /*$data["order_id"] = Uuid::uuid4();
        $data["order_amount"] = 123;
        $data["order_currency"] = "INR";
        $data["customer_details"]["customer_id"] = "walterw1nt0q";
        $data["customer_details"]["customer_name"] = "Amber Sharma";
        $data["customer_details"]["customer_phone"] = "8474090589";
        $data["order_meta"]["return_url"] = ROOT . "/checkout/paymentResponse?order_id={order_id}";
        print_r(CurlRequest::post(CF_URL."/orders", $data));*/

//        $orderdata=array();
//        $orderdata['addressId']=$_POST['addresses'];
//        $orderdata['variantIds']=implode(",", array_keys($_SESSION['variantdata']));
//        $user=$this->load_model("user");
//        $id=$user->saveOrder($orderdata);
//        print_r($id);
//        print_r($_SESSION['variantdata']);
        //header("Location:" . ROOT . "checkout");

    }

    public function paymentResponse()
    {
        echo "<pre>";
        print_r(CurlRequest::get(CF_URL."/orders/".$_REQUEST["order_id"]));
        print_r($_REQUEST);
        $orderdata=array();
        $orderdata['order_id']=$_REQUEST["order_id"];
        $orderdata['status']=$_REQUEST["order_status"];
        $orderdata['addressId']=$_POST['addresses'];
        $orderdata['variantIds']=implode(",", array_keys($_SESSION['variantdata']));$user=$this->load_model("user");
        $id=$user->saveOrder($orderdata);
    }
}