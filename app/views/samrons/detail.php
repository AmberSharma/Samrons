<?php

$this->view("samrons/header", $data);
?>
<link href="<?php echo ASSETS ?>/css/gsap.css" rel="stylesheet">
<body>
<!-- Topbar Start -->
<div class="container-fluid">

    <?php
    include_once "inc/topbar.php";
    include_once 'inc/searchbar.php'; ?>
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
                <?php include_once "inc/navbar.php"; ?>
            </nav>
        </div>
        <div class="col-lg-9">
            <?php include_once "inc/horizontal-navbar.php"; ?>
        </div>
    </div>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="/home">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop Detail</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Detail Start -->
<?php
if (!empty($data["productdata"])) {
    ?>
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">

                <div id="product-carousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner border">
                        <?php
                        if (!empty($data['images'])) {
                            foreach ($data['images'] as $key => $image) {
                                ?>

                                <div class="carousel-item <?php if ($key == 0) echo 'active'; ?>">
                                    <img class="w-100" style="height: 542px;"
                                         src="http://samrons.local/images.php?filename=<?php echo $data['productdata'][0]['vendor_auto_id'] ?>/<?php echo $data['productdata'][0]['product_auto_id'] ?>_<?php echo  $data['variant_auto_id'][$key] ?>/<?php echo $image ?>"
                                         alt="Image">
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>

            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold" id="productName"><?php echo $data['productdata'][0]['name'] ?></h3>
                <!--<div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>

                </div>-->
                <h3 class="font-weight-semi-bold mb-4 ">
                    <span>&#8377;</span><?php echo $data['productdata'][0]['final_price'] ?></h3>
                <p class="mb-4"><?php echo ucfirst($data['productdata'][0]['description']) ?></p>
                <?php
                if (!empty($data['variant_options'])) {
                    foreach ($data['variant_options'] as $key => $variantOption) {
                        ?>
                        <div class="d-flex mb-3">
                            <p class="text-dark font-weight-medium mb-0 mr-3"><?php echo ucfirst($key) ?></p>
                            <form>
                                <?php
                                $count = 1;
                                foreach ($variantOption as $index => $Option) {
                                    ?>
                                    <div id="variantOption" class="custom-control custom-radio custom-control-inline">
                                        <?php if($count==1){?>
                                            <input type="radio" checked class="custom-control-input quantitycheck" id="<?php echo $key."-".$count; ?>" name="<?php echo $key ?>[]" value="<?php echo ucfirst($Option )?>">
                                            <label class="custom-control-label" for="<?php echo $key."-".$count; ?>" ><?php echo ucfirst($Option )?>
                                            </label>
                                        <?php }
                                        else {
                                        ?>
                                        <input type="radio"  class="custom-control-input quantitycheck" id="<?php echo $key."-".$count; ?>" name="<?php echo $key ?>[]" value="<?php echo ucfirst($Option )?>">
                                        <label class="custom-control-label" for="<?php echo $key."-".$count; ?>" ><?php echo ucfirst($Option )?>
                                            <?php } ?>
                                    </div>
                                    <?php
                                    $count++;
                                } ?>
                            </form>
                        </div>
                        <?php
                    }
                }
                ?>
                <label style="display: none" id="outOfStock"></label>

                <?php
                if (!empty($data['variant_combination'])) {
                    foreach ($data['variant_combination'] as $key => $value) {
                        ?>
                        <input type="hidden" id="<?php echo $value ?>" value="<?php echo $key ?>">
                    <?php }
                }
                ?>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus quantitybutton">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" value="1" id="quantity">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus quantitybutton">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary px-3" id="addToCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart
                    </button>
                </div>

            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Product Details</a>
                    <!-- <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>-->
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p><?php echo ucfirst($data['productdata'][0]['description']) ?></p>

                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Product Details</h4>
                        <?php
                        $extraValue = ['id', 'name', 'description', 'vendor_id', 'category_id', 'mrp', 'seller_price', 'gst', "amount_to_seller", "final_price", "tag"];
                        $count = 0;
                        if (!empty($data['productdata'][0])) {
                            foreach ($data['productdata'][0] as $key => $value) {
                                if (!empty($value) && !in_array($key, $extraValue)) {
                                    if ($count == 0) {
                                        ?>
                                        <div class="row">
                                        <?php
                                    }
                                    ?>
                                    <div class="col-md-6">
                                        <?php $count++; ?>
                                        <strong style="color: #5c6bc0"><?php echo ucfirst($key) . ": "; ?></strong><?php echo ucfirst($value) ?>
                                    </div>
                                    <?php
                                    if ($count == 2) {
                                        $count = 0;
                                        ?>
                                        </div>
                                        <br/>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="col-lg-12 col-md-12" style="text-align: center;">
        <?php
        if(!empty($data['productdata'])) {
            ?>
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search by name">
                                <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                </div>
                            </div>
                        </form>
                        <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                Sort by
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="#">Latest</a>
                                <a class="dropdown-item" href="#">Popularity</a>
                                <a class="dropdown-item" href="#">Best Rating</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($data['productdata'] as $key => $productData) {
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100"
                                     src="http://samrons.local/images.php?filename=<?php echo $productData['vendor_id'] ?>/<?php echo $productData['product_id'] ?>_<?php echo $productData['variant_id'] ?>/<?php echo $productData['product_image'] ?>"
                                     alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3"><?php echo $productData['name'] ?></h6>
                                <div class="d-flex justify-content-center">
                                    <h6><?php echo $productData['seller_price'] ?></h6>
                                    <h6 class="text-muted ml-2">
                                        <del><?php echo $productData['seller_price'] ?></del>
                                    </h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="/detail/searchByCategory/<?php echo $productData['product_id'] ?>"
                                   class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                    Detail</a>
                                <a href="" class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="container">
                <h1 class="first-four">4</h1>
                <div class="cog-wheel1">
                    <div class="cog1">
                        <div class="top"></div>
                        <div class="down"></div>
                        <div class="left-top"></div>
                        <div class="left-down"></div>
                        <div class="right-top"></div>
                        <div class="right-down"></div>
                        <div class="left"></div>
                        <div class="right"></div>
                    </div>
                </div>

                <div class="cog-wheel2">
                    <div class="cog2">
                        <div class="top"></div>
                        <div class="down"></div>
                        <div class="left-top"></div>
                        <div class="left-down"></div>
                        <div class="right-top"></div>
                        <div class="right-down"></div>
                        <div class="left"></div>
                        <div class="right"></div>
                    </div>
                </div>
                <h1 class="second-four">4</h1>
                <p class="wrong-para">Uh Oh! No Matching Product found!</p>
            </div>
            <?php
        }
        ?>
    </div>
<?php
}
?>

<!-- Shop Detail End -->


<!-- Footer Start -->
<?php
include_once "inc/similar-products.php";
include_once "footer.php";
?>


<!-- JavaScript Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.5/gsap.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS ?>js/gsap.js"></script>
<script src="<?php echo ASSETS ?>js/lib/owlcarousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS ?>js/main.js"></script>

</body>

</html>