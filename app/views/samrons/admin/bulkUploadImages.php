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
        box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
    }
    .img-wrap {
        position: relative;
        width: 200px;
        height: 200px;
        float: left;
    }
    .img-wrap .close {
        position: absolute;
        top: 5px;
        right: 15px;
        z-index: 100;
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
                                <li class="active">Bulk Upload Images</li>
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
                            <strong class="card-title">Bulk Upload Images</strong>
                        </div>
                        <div class="card-body">

                            <div class="Neon Neon-theme-dragdropbox">
                                <input style="z-index: 999; opacity: 0; width: 320px; height: 200px; position: absolute; right: 0px; left: 0px; margin-right: auto; margin-left: auto;"
                                       name="bulkUploadImages[]" id="bulkUploadImages" multiple="multiple" type="file">
                                <div class="Neon-input-dragDrop">
                                    <div class="Neon-input-inner">
                                        <div class="Neon-input-icon"><i class="fa fa-file-image-o"></i></div>
                                        <div class="Neon-input-text"><h3>Drag & Drop files here</h3> <span
                                                    style="display:inline-block; margin: 15px 0">or</span></div>
                                        <a class="Neon-input-choose-btn blue">Browse Files</a></div>
                                </div>
                                <div style="text-align: center">
                                    <button type="button" id="bulkUploadImagesButton" class="btn btn-warning">Upload</button>
                                    <button type="button" id="bulkUploadImagesUrlButton" class="btn btn-info">Get Image Urls</button>
                                </div>
                            </div>
                            <div id="uploadedImageDiv" style="padding-top: 5px;"></div>
                            <div id="savedImageDiv" style="padding-top: 5px;"></div>
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
