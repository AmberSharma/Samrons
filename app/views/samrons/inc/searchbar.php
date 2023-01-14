<div class="row align-items-center py-3 px-xl-5">
    <div class="col-lg-3 d-none d-lg-block" style="text-align: center;">
        <a href="/home">
            <img src="<?php echo ASSETS ?>img/logo.png" height="100">
        </a>
    </div>
    <div class="col-lg-6 col-6 text-left">
        <form action="/shop/searchProducts/" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="searchtext" placeholder="Search for products">
                <div class="input-group-append">
                            <button class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-3 col-6 text-right">
<!--        <a href="" class="btn border">-->
<!--            <i class="fas fa-heart text-primary"></i>-->
<!--            <span class="badge">0</span>-->
<!--        </a>-->
        <a href="/cart/viewCart" class="btn border">
            <i class="fas fa-shopping-cart text-primary"></i>
            <span class="badge" id="cartcount"><?php echo isset($_SESSION["variantdata"]) ? count($_SESSION["variantdata"]): 0; ?></span>
        </a>
    </div>
</div>