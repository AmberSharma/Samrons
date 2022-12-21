
<?php
include_once "inc/header.php";
?>
<style>
    input.error {
        border: 2px solid #CC0000
    }

    select.error {
        border: 2px solid #CC0000
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
    <?php
    include_once 'inc/menu.php';
    ?>
    <!-- Header-->

    <div class="breadcrumbs">
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
    </div>
    <div class="content">
        <div class="animated fadeIn">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header"><strong>Product Category</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-floating">
                                            <select id="cat__0" class="form-control category-subset" name="category">
                                                <option> ---Select Category---</option>
                                                <?php
                                                if (!empty($data['categories'])) {
                                                    $categoriesArr = json_decode($data['categories'], true);
                                                    foreach ($categoriesArr as $category) {
                                                        echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <label>Parent Category</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header"><strong>Product</strong><strong>Details</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label for="productname" class=" form-control-label">Product
                                        Name</label><input type="text" id="proname"
                                                           placeholder="Enter your Product Name"
                                                           class="form-control" name="proname"></div>
                                <div class="form-group"><label for="productdesc" class=" form-control-label">Product
                                        Description</label><input type="text" id="prodesc" name="prodesc"
                                                                  placeholder="Enter Product Description"
                                                                  class="form-control"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <strong>Variant Details</strong>
                                <button type="button" class="btn btn-primary" id="plus"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="card-body card-block">
                                <!--                            <div class="form-group row">-->
                                <!--                                <div class="col-sm-4">-->
                                <!--                                    <select id="pro__0" class="form-control category-subset">-->
                                <!--                                        <option> ---Select Option---</option>-->
                                <!--                                        --><?php
                                //                                        if (!empty($data['options'])) {
                                //                                            $optionArr = json_decode($data['options'], true);
                                //                                            foreach ($optionArr as $option) {
                                //                                                echo "<option value='" . $option['id'] . "'>" . $option['name'] . "</option>";
                                //                                            }
                                //                                        }
                                //                                        ?>
                                <!--                                    </select>-->
                                <!--                                </div>-->
                                <!--                                <div class="col-sm-6 optionval">-->
                                <!--                                    <input type="textarea" id="optionvalue__0" placeholder="Enter Option Values"-->
                                <!--                                           class="form-control" name="tags">-->
                                <!--                                </div>-->
                                <!--                                <div class="col-sm-2">-->
                                <!--                                    <button type="button" class="btn btn-primary" id="plus"><i class="fa fa-plus"></i>-->
                                <!--                                    </button>-->
                                <!--                                </div>-->
                                <!--                            </div>-->


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-header"><strong>Option Value Combinations</strong>
                            <button type="button" class="btn btn-primary" id="refresh" style="float: right;"><i
                                        class="fa fa-refresh" aria-hidden="true"></i></button>
                        </div>
                        <div class="card-body card-block" id="optionValueCombination">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <input type="button" class="btn btn-success" id="addProductDetails" value="Save"></input>
                    </div>
                </div>
        </div>
        </form>

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


</body>
</html>
