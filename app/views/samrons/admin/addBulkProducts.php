<?php
include_once "inc/header.php";
?>
<style>
    .Neon {
        font-family: sans-serif;
        font-size: 14px;
        color: #494949;
        position: relative;


    }

    .Neon * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .Neon-input-dragDrop {
        display: block;
        width: 343px;
        margin: 0 auto 25px auto;
        padding: 25px;
        color: #8d9499;
        color: #97A1A8;
        background: #fff;
        border: 2px dashed #C8CBCE;
        text-align: center;
        -webkit-transition: box-shadow 0.3s, border-color 0.3s;
        -moz-transition: box-shadow 0.3s, border-color 0.3s;
        transition: box-shadow 0.3s, border-color 0.3s;
    }

    .Neon-input-dragDrop .Neon-input-icon {
        font-size: 48px;
        margin-top: -10px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    .Neon-input-text h3 {
        margin: 0;
        font-size: 18px;
    }

    .Neon-input-text span {
        font-size: 12px;
    }

    .Neon-input-choose-btn.blue {
        color: #008BFF;
        border: 1px solid #008BFF;
    }

    .Neon-input-choose-btn {
        display: inline-block;
        padding: 8px 14px;
        outline: none;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        white-space: nowrap;
        font-size: 12px;
        font-weight: bold;
        color: #8d9496;
        border-radius: 3px;
        border: 1px solid #c6c6c6;
        vertical-align: middle;
        background-color: #fff;
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.05);
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
    }
</style>
<body>
<!-- Left Panel -->
<?php
include_once "inc/leftpanel.php";
?>
<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <?php
    include_once 'inc/menu.php';
    ?>

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
                                <li><a href="#">Pages</a></li>
                                <li class="active">Add Bulk Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="animated fadeIn">
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
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header"><strong>Product Upload Template</strong></div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="Neon Neon-theme-dragdropbox">
                                        <input style="z-index: 999; opacity: 0; width: 320px; height: 200px; position: absolute; right: 0px; left: 0px; margin-right: auto; margin-left: auto;"
                                               name="bulkUploadProducts[]" id="bulkUploadProducts"
                                               type="file">
                                        <div class="Neon-input-dragDrop">
                                            <div class="Neon-input-inner">
                                                <div class="Neon-input-icon"><i class="fa fa-plus-square-o"></i></div>
                                                <div class="Neon-input-text">
                                                    <h3>Upload Template File</h3>
                                                    <span style="display:inline-block; margin: 15px 0"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="text-align: center">
                                            <button type="button" id="bulkUploadProductsButton" class="btn btn-warning">
                                                Upload
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-top: 20px;">
                                <div class="col-sm-12" style="text-align: center;">
                                    <div>
                                        Do not have the template?
                                    </div>
                                    <div style="padding-top: 10px;">
                                        <button type="button" id="downloadBulkUploadTemplate" class="btn btn-info">
                                            Download Template
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->


</body>
</html>
