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

    .form-group {
        padding-bottom: 5px;
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
                                <li class="active">Add Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="animated fadeIn">
            <form method="post" enctype="multipart/form-data" id="addProductForm">
                <div class="row">
                    <div class="alert alert-success" role="alert"></div>
                    <div class="alert alert-danger" role="alert"></div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header"><strong>Product Category</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-floating">
                                            <select id="cat__0" class="form-control category-subset" name="category">
                                                <option value=""> ---Select Category---</option>
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
                        <div class="card">
                            <div class="card-header"><strong>Product Price</strong></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-floating">
                                            <input type="text" id="promrp"
                                                   class="form-control" name="mrp">
                                            <label>MRP (&#8377;)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-floating">
                                            <input type="text" id="prosellerprice"
                                                   class="form-control" name="seller_price">
                                            <label>Seller Price (&#8377;)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-floating">
                                            <select id="progst" class="form-control category-subset" name="gst">
                                                <option value="">--- SELECT GST ---</option>
                                                <option value="5">5%</option>
                                                <option value="12">12%</option>
                                                <option value="18">18%</option>
                                                <option value="28">28%</option>
                                            </select>
                                            <label>GST %</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Product Details</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="proname"
                                                   class="form-control" name="name">
                                            <label>Name</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="probrand"
                                                   class="form-control" name="brand">
                                            <label>Brand</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="proweight"
                                                   class="form-control" name="weight">
                                            <label>Weight</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="prostylecode"
                                                   class="form-control" name="style_code">
                                            <label>Style Code</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="profabric"
                                                   class="form-control" name="fabric">
                                            <label>Fabric</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="procollar"
                                                   class="form-control" name="collar">
                                            <label>Collar</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="prosleevelength"
                                                   class="form-control" name="sleeve_length">
                                            <label>Sleeve length</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="procountryorigin"
                                                   class="form-control" name="country_origin">
                                            <label>Country of Origin</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="profitshape"
                                                   class="form-control" name="fit_shape">
                                            <label>Fit Shape</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="prooccasion"
                                                   class="form-control" name="occasion">
                                            <label>Occasion</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="propatterntype"
                                                   class="form-control" name="pattern_type">
                                            <label>Pattern Type</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="proneck"
                                                   class="form-control" name="neck">
                                            <label>Neck</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="prosolid"
                                                   class="form-control" name="solid">
                                            <label>Solid</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" id="prolength"
                                                   class="form-control" name="length">
                                            <label>Length</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                                <textarea type="text" class="form-control" id="prodesc"
                                                          required="required"
                                                          style="height: 100px" name="description"></textarea>
                                            <label>Description</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <textarea type="text" class="form-control" id="propackerdetail"
                                                      style="height: 100px" name="packers_detail"></textarea>
                                            <label>Packer's Detail</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <strong>Variant Details</strong>
                                <button type="button" class="btn btn-primary" id="plus" style="float: right;"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="card-body card-block">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="background-color: #587319;"><strong>Final Price</strong></div>
                            <div class="card-body card-block" style="background-color: #8ead45;"></div>
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
