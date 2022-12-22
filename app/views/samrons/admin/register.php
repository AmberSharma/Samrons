<?php
    include_once "inc/header.php";
?>
<script type="text/javascript" src="<?php echo ASSETS ?>js/script.js"></script>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="/">
                        <img class="align-content" src="<?php echo ASSETS ?>img/logo-3.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <?php
                    if (isset($_REQUEST["message"])) {
                    ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong> <?php echo $_REQUEST["message"]; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($data["errors"])) {
                        ?>
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            <div>
                            <?php
                            foreach ($data["errors"] as $key => $value) {
                                ?>
                                <strong><?php echo $key.": " ?> </strong> <?php echo implode(",", $value);?><br/>
                                <?php
                            }
                            ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <form  method="post" enctype="multipart/form-data" id="registerForm">
                        <div class="row">
                            <label>Register As:</label>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check user_type" name="chktype" id="chkUser" value="User" autocomplete="off">
                                <label class="btn btn-outline-warning" for="chkUser">Customer</label>

                                <input type="radio" class="btn-check user_type" name="chktype" id="chkVendor" value="Vendor" autocomplete="off" checked>
                                <label class="btn btn-outline-warning" for="chkVendor">Vendor</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Name</label>
                                <input type="text" class="form-control" id="uname" placeholder="Name" name="uname">
                            </div>
                            <div class="col-sm-6">
                                <label>Phone Number</label>
                                <input type="number" class="form-control" id="uphone" placeholder="Phone Number" name="uphone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" id="uemail" placeholder="Email Address" name="uemail">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Password</label>
                                <input type="password" class="form-control" id="upass" placeholder="Password" name="upass">
                            </div>
                            <div class="col-sm-6">
                                <label>Confirm Password</label>
                                <input type="text" class="form-control" id="upass2" placeholder="Confirm Password" name="upass2">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Aadhar Number</label>
                                <input type="text" class="form-control" id="aadhar" placeholder="Aadhar Number" name="aadhar">
                            </div>
                            <div class="col-sm-6">
                                <label>Pancard Number</label>
                                <input type="text" class="form-control" id="pancard" placeholder="Pancard Number" name="pancard">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>GST Number</label>
                                <input type="text" class="form-control" id="gst" placeholder="GST Number" name="gst">
                            </div>
                            <div class="col-sm-6">
                                <label>Current Account Number</label>
                                <input type="text" class="form-control" id="caccountnumber" placeholder="Current Account Number" name="caccountnumber">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="formFile" class="form-label">Cancel Cheque</label><div id="cancelchequeImagePreview" style="height: 20px; width: 10%; display: none;"></div>
                                <input class="form-control" type="file" name="cancelcheque" id="cancelcheque">

                            </div>
                            <div class="col-sm-6">
                                <label for="formFile" class="form-label">Photo</label>
                                <input class="form-control" type="file" name="photo" id="photo">
                                <div id="photoImagePreview" style="height: 20px; width: 10%; display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="formFile" class="form-label">Signature</label>
                                <input class="form-control" type="file"  name="sign" id="sign">
                                <div id="signImagePreview" style="height: 20px; width: 10%; display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 5%">
                            <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" id="registerButton">Register</button>
                        </div>
<!--                        <div class="checkbox">-->
<!--                            <label>-->
<!--                                <input type="checkbox"> Agree the terms and policy-->
<!--                            </label>-->
<!--                        </div>-->

<!--                        <div class="social-login-content">-->
<!--                            <div class="social-button">-->
<!--                                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Register with facebook</button>-->
<!--                                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Register with twitter</button>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="register-link m-t-15 text-center">
                            <p>Already have account ? <a href="login"> Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
