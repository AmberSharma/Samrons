<!DOCTYPE html>
<html lang="en">

<?php
/*echo "<pre>"; print_r($data);echo "</pre>";*/

$this->view("samrons/header", $data);
$totalAmount=0;
?>

<body>
<!-- Topbar Start -->
<div class="container-fluid">
    <?php include_once 'inc/topbar.php';?>
    <?php include_once 'inc/searchbar.php';?>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
               data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                 id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                <?php
                include_once 'inc/navbar.php';
                ?>
            </nav>
        </div>
        <div class="col-lg-9">
            <?php include_once "inc/horizontal-navbar.php" ;?>
        </div>
    </div>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Checkout</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<div classclass="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">

        </div>
    </div>
</div>
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div class="card border-secondary mb-5">
                <?php
                if (!empty($data['addressdetails'])) {
                    foreach ($data['addressdetails'] as $key => $value) {
                        ?>
                        <div class="mb-4">
                            <div class="col-md-12 form-group">
                                <div class="custom-control custom-checkbox">


                                    <input type="radio" checked name="addresses" value="<?php echo $value['id'] ?>">
                                    <label name="addresslabel"><?php echo $value['add_line_1'] ?> <?php echo $value['add_line_2'] ?>
                                        <br><?php echo $value['city'] ?> <br><?php echo $value['state'] ?>
                                        <br><?php echo $value['pincode'] ?></label>

                                </div>

                            </div>
                        </div>
                        <?php
                    }
                }?>
                <a href="#" id="showadd">Click Here To save New Address </a>
            </div>
            <div class="card border-secondary mb-5">
            <div class="mb-4 newaddress" style="display: none">
                <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
           <form method="post" action="/checkout/addAddress">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input name="add_line_1" class="form-control" type="text" placeholder="Enter your address">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input name="add_line_2" class="form-control" type="text" placeholder="Enter Your Address">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input name="country" class="form-control" type="text" placeholder="Enter Your Country">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input name="city" class="form-control" type="text" placeholder="Enter Your City">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input name="state" class="form-control" type="text" placeholder="Enter Your State">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>PIN Code</label>
                            <input name="pincode" class="form-control" type="text" placeholder="123">
                        </div>
                        <a href="/checkout/addAddress/">
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Save</button>
                        </a>
                    </div>
           </form>
            </div>
            </div>

        </div>

        <div class="col-lg-4">
<!--            <form onsubmit="return false;" id="paymentForm">-->
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Products</h5>
                    <?php foreach($data['variantData'] as $variantdata){
                        $totalAmount=($variantdata['final_price']*$_SESSION['variantdata'][$variantdata['variant_id']])+$totalAmount;
                        ?>
                        <div class="d-flex justify-content-between">
                            <p><b><?php echo ucwords( $variantdata['name'])?> </b>(<?php echo $variantdata['combination']?>) X <?php echo $_SESSION['variantdata'][$variantdata['variant_id']]?> </p>
                            <p><?php echo $variantdata['final_price'] * $_SESSION['variantdata'][$variantdata['variant_id']]?></p>
                        </div>
                    <?php } ?>
                    <!--   <div class="d-flex justify-content-between">
                           <p>Colorful Stylish Shirt 2</p>
                           <p>$150</p>
                       </div>
                       <div class="d-flex justify-content-between">
                           <p>Colorful Stylish Shirt 3</p>
                           <p>$150</p>
                       </div>-->
                    <hr class="mt-0">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium"><?php echo $totalAmount?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">Free</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold"><?php echo $totalAmount?></h5>
                    </div>
                </div>
            </div>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Payment</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="paypal" value="online">
                            <label class="custom-control-label" for="paypal">Paytm</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="COD" value="COD">
                            <label class="custom-control-label" for="directcheck">Cash On Delivery</label>
                        </div>
                    </div>

                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <button  type="button" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" id="checkoutSubmitButton"> Proceed to Payment</button>
                </div>
            </div>
<!--            </form>-->
        </div>



    </div>


<!-- Checkout End -->


<!-- Footer Start -->

<?php $this->view("samrons/footer"); ?>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->

<?php
$debug = true;
if($debug) {
    ?>
    <script type="text/javascript" src="https://sdk.cashfree.com/js/ui/2.0.0/cashfree.sandbox.js"></script>
<?php
} else {
?>
    <script type="text/javascript" src="https://sdk.cashfree.com/js/ui/2.0.0/cashfree.prod.js"></script>
    <?php
}
?>

</body>

</html>