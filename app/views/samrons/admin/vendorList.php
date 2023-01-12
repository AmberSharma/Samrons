<? print_r( $data); ?>
<?php
    include_once "inc/header.php";
?>
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
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Aadhar</th>
                                            <th>Pancard</th>
                                            <th>GST Number</th>
                                            <th>Photo</th>
                                            <th>Signature</th>
                                            <th>Approve/Reject</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $dir=getcwd()?>




                                    <?php if($data["vendordata"]!=""){

                                    foreach ($data["vendordata"] as $res)
                                    {
                                        ?>
                                        <tr>
                                            <td> <?php echo $res["name"] ?></td>
                                            <td><?php echo $res["email"] ?></td>
                                            <td><?php echo $res["phone_number"] ?></td>
                                            <td><?php echo $res["aadhar"] ?></td>
                                            <td><?php echo $res["pancard"] ?></td>
                                            <td><?php echo $res["gst"] ?></td>
                                            <td><img src="http://samrons.local/images.php?filename=<?php echo $res["id"] ?>/<?php echo $res["photo"]?>.jpeg" alt="sdggsd" height="30" width="30"/></td>
                                            <td><img src="http://samrons.local/images.php?filename=<?php echo $res["id"] ?>/<?php echo $res["signature"]?>.jpg" alt="sdggsd" height="30" width="30"/></td>

                                            <td><input id="approve" type="button" class="btn btn-success" data-id="<?php echo $res["id"] ?>" value="Approve" style="width:auto"/><input id="reject" data-id="<?php echo $res["id"] ?>"  type="button" class="btn btn-danger" value="Reject" style="width:auto"/> </td>
                                        </tr>
<?php }} ?>
                                    </tbody>
                                </table>
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
