<? print_r( $data); ?>
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
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Add Category</strong>
                        </div>
                        <div class="card-body">
                            <form  method="post" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" id="cname" placeholder="Category Name" name="cname"
                                               required="required" data-validation-required-message="Please enter category name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Description</label>
                                        <input type="text" class="form-control" id="desc" placeholder="Description" name="desc"
                                               required="required" data-validation-required-message="Please enter Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Parent Category</label>
                                        <select id="cat__0" class="form-control category-subset">
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
                                    </div>
                                </div>


                                <div class="form-group row" style="margin-top: 5%">
                                    <input type="button" class="btn btn-success" id="addCategoryButton" value="Save"></input>
                                </div>

                            </form>
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
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>


<script src="<?php echo ASSETS ?>js/data-table/datatables.min.js"></script>
<script src="<?php echo ASSETS ?>js/data-table/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS ?>js/data-table/dataTables.buttons.min.js"></script>
<script src="<?php echo ASSETS ?>js/data-table/buttons.bootstrap.min.js"></script>
<script src="<?php echo ASSETS ?>js/data-table/jszip.min.js"></script>
<script src="<?php echo ASSETS ?>js/data-table/vfs_fonts.js"></script>
<script src="<?php echo ASSETS ?>js/data-table/buttons.html5.min.js"></script>
<script src="<?php echo ASSETS ?>js/data-table/buttons.print.min.js"></script>
<script src="<?php echo ASSETS ?>js/data-table/buttons.colVis.min.js"></script>
<script src="<?php echo ASSETS ?>js/data-table/datatables-init.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    } );
</script>


</body>
</html>
