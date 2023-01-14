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
            <p class="m-0">Tracking</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<p>Order Placed Successfully !!!!!!</p>

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