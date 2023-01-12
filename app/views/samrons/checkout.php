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
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
<!--            <form action="">-->
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                    </div>
                </div>
<!--            </form>-->
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">0</span>
            </a>
            <a href="" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">0</span>
            </a>
        </div>
    </div>
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
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">Dresses <i
                                    class="fa fa-angle-down float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <a href="" class="dropdown-item">Men's Dresses</a>
                            <a href="" class="dropdown-item">Women's Dresses</a>
                            <a href="" class="dropdown-item">Baby's Dresses</a>
                        </div>
                    </div>
                    <a href="" class="nav-item nav-link">Shirts</a>
                    <a href="" class="nav-item nav-link">Jeans</a>
                    <a href="" class="nav-item nav-link">Swimwear</a>
                    <a href="" class="nav-item nav-link">Sleepwear</a>
                    <a href="" class="nav-item nav-link">Sportswear</a>
                    <a href="" class="nav-item nav-link">Jumpsuits</a>
                    <a href="" class="nav-item nav-link">Blazers</a>
                    <a href="" class="nav-item nav-link">Jackets</a>
                    <a href="" class="nav-item nav-link">Shoes</a>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.html" class="nav-item nav-link">Home</a>
                        <a href="shop.php" class="nav-item nav-link">Shop</a>
                        <a href="detail.php" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.php" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        <a href="" class="nav-item nav-link">Login</a>
                        <a href="" class="nav-item nav-link">Register</a>
                    </div>
                </div>
            </nav>
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
            <?php
            foreach ($data['addressdetails'] as $key => $value) {
                ?>
                <div class="mb-4">
                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">


                            <input type="radio" name="addresses" value="<?php echo $value['id']?>">
                            <label name="addresslabel" ><?php echo $value['add_line_1'] ?> <?php echo $value['add_line_2'] ?>
                                <br><?php echo $value['city'] ?> <br><?php echo $value['state'] ?>
                                <br><?php echo $value['pincode'] ?></label>

                        </div>

                    </div>
                </div>
                <?php
            } ?>
            <a href="#" id="showadd">Click Here To save New Address </a>
        </div>
    </div>
</div>
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div class="mb-4 newaddress" style="display: none">
                <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
           <form method="post" action="/checkout/addAddress">
                    <div class="row">
                        <!--      <div class="col-md-6 form-group">
                                  <label>First Name</label>
                                  <input class="form-control" type="text" placeholder="John">
                              </div>
                              <div class="col-md-6 form-group">
                                  <label>Last Name</label>
                                  <input class="form-control" type="text" placeholder="Doe">
                              </div>
                              <div class="col-md-6 form-group">
                                  <label>E-mail</label>
                                  <input class="form-control" type="text" placeholder="example@email.com">
                              </div>
                              <div class="col-md-6 form-group">
                                  <label>Mobile No</label>
                                  <input class="form-control" type="text" placeholder="+123 456 789">
                              </div>-->
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
<!--                        <a href="/checkout/addAddress/">-->
<!--                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Save</button>-->
<!--                        </a>-->
                        <!-- <div class="col-md-12 form-group">
                             <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="custom-control-input" id="newaccount">
                                 <label class="custom-control-label" for="newaccount">Create an account</label>
                             </div>
                         </div>
                         <div class="col-md-12 form-group">
                             <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="custom-control-input" id="shipto">
                                 <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                             </div>
                         </div>-->
                    </div>
           </form>
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
                        $totalAmount=($variantdata['seller_price']*$_SESSION['variantdata'][$variantdata['variant_id']])+$totalAmount;
                        ?>
                        <div class="d-flex justify-content-between">
                            <p><b><?php echo ucwords( $variantdata['name'])?> </b>(<?php echo $variantdata['combination']?>) X <?php echo $_SESSION['variantdata'][$variantdata['variant_id']]?> </p>
                            <p><?php echo $variantdata['seller_price'] * $_SESSION['variantdata'][$variantdata['variant_id']]?></p>
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
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
            </a>
            <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore
                amet erat.</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-dark mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                        <a class="text-dark mb-2" href="detail.php"><i class="fa fa-angle-right mr-2"></i>Shop
                            Detail</a>
                        <a class="text-dark mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Shopping
                            Cart</a>
                        <a class="text-dark mb-2" href="checkout.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                        <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-dark mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                        <a class="text-dark mb-2" href="detail.php"><i class="fa fa-angle-right mr-2"></i>Shop
                            Detail</a>
                        <a class="text-dark mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Shopping
                            Cart</a>
                        <a class="text-dark mb-2" href="checkout.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                        <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
<!--                <div class="col-md-4 mb-5">-->
<!--                    <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>-->
<!--                    <form action="">-->
<!--                        <div class="form-group">-->
<!--                            <input type="text" class="form-control border-0 py-4" placeholder="Your Name"-->
<!--                                   required="required"/>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <input type="email" class="form-control border-0 py-4" placeholder="Your Email"-->
<!--                                   required="required"/>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
            </div>
        </div>
    </div>
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-dark">
                &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved.
                Designed
                by
                <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="img/payments.png" alt="">
        </div>
    </div>
</div>
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