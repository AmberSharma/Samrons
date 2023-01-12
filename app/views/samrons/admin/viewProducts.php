<? print_r( $data); ?>
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
        <?php include_once  'inc/menu.php' ?>
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

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Product List</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>MRP</th>
                                        <th>Seller Price</th>
                                        <th></th>
                                        <th>Quantity</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $dir=getcwd()?>

                                    <?php

                                    //echo "<pre>";print_r($data["productData"]);
                                    if(!empty($data["productData"])){
                                        $page = 0;
                                        $dataCount = count($data["productData"]);
                                        if (isset($_REQUEST["page"])
                                            && is_numeric($_REQUEST["page"])
                                            && $_REQUEST["page"] > 0
                                            && $_REQUEST["page"] <= count($data["productData"])
                                        ) {
                                            $page = $_REQUEST["page"] - 1;
                                        }

                                        foreach ($data["productData"][$page] as $productId => $res)
                                        {
                                            $variantCount = count($res["variant_data"]);
                                            $count = 0;
                                            foreach ($res["variant_data"] as $variantId => $variant_res) {
                                                ?>
                                                <tr>
                                                    <?php
                                                    if($count == 0) {
                                                        $count ++;
                                                        ?>
                                                        <td rowspan="<?php echo $variantCount;?>" style="width: 20%"> <?php echo $res["name"] ?></td>
                                                        <td rowspan="<?php echo $variantCount;?>"><?php echo $res["category_name"] ?></td>
                                                        <td style="width: 10%" rowspan="<?php echo $variantCount;?>">
                                                            <div class="form-group ">
                                                                <input type="text" class="form-control" id="inputZip" value="<?php echo $res["mrp"] ?>">
                                                            </div>
                                                        </td>
                                                        <td style="width: 10%" rowspan="<?php echo $variantCount;?>">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="inputZip" value="<?php echo $res["seller_price"] ?>">
                                                            </div>
                                                        </td>
                                                        <?php
                                                    } ?>
                                                    <td style="width: 20%">
                                                        <img src="http://samrons.local/images.php?filename=<?php echo $res["vendor_id"] ?>/<?php echo $productId ?>_<?php echo $variantId ?>/<?php echo $variant_res["product_image"] ?>"
                                                             height="100" width="100"/></td>
                                                    <td style="width: 10%">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="inputZip"
                                                                   value="<?php echo $variant_res["quantity"] ?>">
                                                        </div>
                                                    </td>
                                                    <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?php echo $variantId ?></td>

                                                </tr>
                                            <?php }}} ?>
                                    </tbody>
                                </table>
                                <nav aria-label="...">
                                    <ul class="pagination pagination-lg">
                                        <?php
                                        for($i = 1; $i <= $dataCount; $i ++) {
                                            ?>
                                            <li class="page-item <?php if($page == $i){ ?>disabled <?php }?>">
                                                <a class="page-link" href="/vendor/viewProducts?page=<?php echo $i ?>" tabindex="-1"><?php echo $i ?></a>
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


        <div class="clearfix"></div>

        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <!-- Scripts -->
    


</body>
</html>
