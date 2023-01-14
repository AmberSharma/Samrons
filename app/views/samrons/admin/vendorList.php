<?php
    include_once "inc/header.php";
?>
<style>
    img {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    img:hover {opacity: 0.7;}

    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        /*z-index: 1; !* Sit on top *!*/
        padding-top: 100px; /* Location of the box */
        /*left: 0;*/
        /*top: 0;*/
        /*width: 50%; !* Full width *!*/
        /*height: 50%; !* Full height *!*/
        overflow: auto; /* Enable scroll if needed */
        /*background-color: rgb(0,0,0); !* Fallback color *!*/
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 500px;
        max-height: 600px;
    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation - Zoom in the Modal */
    .modal-content, #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
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

<!--        <div class="breadcrumbs">-->
<!--            <div class="breadcrumbs-inner">-->
<!--                <div class="row m-0">-->
<!--                    <div class="col-sm-4">-->
<!--                        <div class="page-header float-left">-->
<!--                            <div class="page-title">-->
<!--                                <h1>Dashboard</h1>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-sm-8">-->
<!--                        <div class="page-header float-right">-->
<!--                            <div class="page-title">-->
<!--                                <ol class="breadcrumb text-right">-->
<!--                                    <li><a href="#">Dashboard</a></li>-->
<!--                                    <li><a href="#">Table</a></li>-->
<!--                                    <li class="active">Data table</li>-->
<!--                                </ol>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
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
                                            <th>Cheque</th>
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
                                            <td style="text-align: center;"><img class="expandable" src="http://samrons.local/images.php?filename=<?php echo $res["auto_id"] ?>/<?php echo $res["photo"]?>" alt="Vendor Photo" height="50" width="50"/></td>
                                            <td style="text-align: center;"><img class="expandable" src="http://samrons.local/images.php?filename=<?php echo $res["auto_id"] ?>/<?php echo $res["signature"]?>" alt="Vendor Signature" height="50" width="50"/></td>
                                            <td style="text-align: center;"><img class="expandable" src="http://samrons.local/images.php?filename=<?php echo $res["auto_id"] ?>/<?php echo $res["cheque"]?>" alt="Vendor Cheque" height="50" width="50"/></td>
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

<!--        <div class="clearfix"></div>-->
<!---->
<!--        <footer class="site-footer">-->
<!--            <div class="footer-inner bg-white">-->
<!--                <div class="row">-->
<!--                    <div class="col-sm-6">-->
<!--                        Copyright &copy; 2018 Ela Admin-->
<!--                    </div>-->
<!--                    <div class="col-sm-6 text-right">-->
<!--                        Designed by <a href="https://colorlib.com">Colorlib</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </footer>-->

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
    <script src="<?php echo ASSETS ?>js/admin.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          // $('#bootstrap-data-table-export').DataTable();

            $(".expandable").click(function() {
                let modal = $("#myModal");

                // Get the image and insert it inside the modal - use its "alt" text as a caption
                let modalImg = $("#img_modal");
                let captionText = $("#caption");

                modal.css("display","block");
                modalImg.attr("src",this.src);
                captionText.html(this.alt);

                // When the user clicks on <span> (x), close the modal
                $(".close").click(function() {
                    modal.css("display","none");
                });
            });



        });


    </script>


</body>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img_modal">
    <div id="caption"></div>
</div>
</html>
