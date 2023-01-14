<?php

include_once "inc/header.php";
?>
<style>
    td {
        text-align: center;
        vertical-align: middle;
    }
</style>


<body>
<!-- Left Panel -->
<?php
include_once "inc/leftpanel.php";
?>
<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <?php include_once 'inc/menu.php' ?>
    <!-- Header-->

    <!--<div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Table</a></li>
                                <li class="active">Data table</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="alert alert-success" role="alert"></div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Order List</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Shipping Address</th>
                                    <th></th>
                                    <th>Date Of Order</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $dir = getcwd() ?>

                                <?php

                                $dataCount = 0;
                                if (!empty($data["orderData"])) {
                                    $page = 0;
                                    $dataCount = count($data["orderData"]);
                                    if (isset($_REQUEST["page"])
                                        && is_numeric($_REQUEST["page"])
                                        && $_REQUEST["page"] > 0
                                        && $_REQUEST["page"] <= count($data["orderData"])
                                    ) {
                                        $page = $_REQUEST["page"] - 1;
                                    }

                                    foreach ($data["orderData"][$page] as $key => $value) {
                                        $variantCount = count($value);
                                        $count = 0;
                                        ?>
                                        <tr>
                                            <?php
                                            if ($count == 0) {
                                                $count++;
                                                ?>
                                                <td > #ORD000<?php echo $value["id"] ?></td>
                                                <td ><?php echo $value["item_quantity"] ?></td>
                                                <td  >
                                                    <?php echo $value["price"] ?>
                                                </td>
                                                <td  >
                                                    <div class="form-group">
                                                        <?php echo $value["add_line_1"] ?> <?php echo $value["add_line_2"] ?>
                                                        <?php echo $value["city"] ?>
                                                        <?php echo $value["state"] ?> <?php echo $value["country"] ?>
                                                        <?php echo $value["pincode"] ?>

                                                    </div>
                                                </td>
                                                <?php
                                            } ?>
                                            <td>
                                                <img src="http://samrons.local/images.php?filename=<?php echo $value["vendor_id"] ?>/<?php echo $value["product_id"] ?>_<?php echo $value["variant_id"] ?>/<?php echo $value["product_image"] ?>"
                                                     height="100" width="100"/></td>
                                            <td>
                                                <?php echo $value["timestamps"] ?>
                                            </td>
                                            <!--  <td><input id="updatevariant" type="button" class="btn btn-success updatevariant"
                                                           data-id="<?php /*echo $variantId */?>"
                                                           data-pro-id="<?php /*echo $productId */?>" value="Save"
                                                           style="width:auto"/><input id="deleteproduct"
                                                                                      data-id="<?php /*echo $productId */?>"
                                                                                      type="button"
                                                                                      class="btn btn-danger deleteproduct"
                                                                                      value="Delete"
                                                                                      style="width:auto"/></td>-->

                                        </tr>
                                    <?php }
                                }
                                ?>
                                </tbody>
                            </table>
                            <nav aria-label="...">
                                <ul class="pagination pagination-lg">
                                    <?php
                                    for ($i = 1; $i <= $dataCount; $i++) {
                                        ?>
                                        <li class="page-item <?php if (($page + 1) == $i) { ?>disabled <?php } ?>">
                                            <a class="page-link" href="/vendor/viewOrders?page=<?php echo $i ?>"><?php echo $i ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <!--                                        <li class="page-item"><a class="page-link" href="/vendor/viewProducts?page=2">2</a></li>-->
                                    <!--                                        <li class="page-item"><a class="page-link" href="#">3</a></li>-->
                                </ul>
                            </nav>
                        </div>


                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->


<!--    <div class="clearfix"></div>-->
<!---->
<!--    <footer class="site-footer">-->
<!--        <div class="footer-inner bg-white">-->
<!--            <div class="row">-->
<!--                <div class="col-sm-6">-->
<!--                    Copyright &copy; 2018 Ela Admin-->
<!--                </div>-->
<!--                <div class="col-sm-6 text-right">-->
<!--                    Designed by <a href="https://colorlib.com">Colorlib</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </footer>-->

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->


</body>
<script src="<?php echo ASSETS ?>js/vendor.js"></script>
</html>



