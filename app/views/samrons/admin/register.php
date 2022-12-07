<?php
    include_once "inc/header.php";
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo ASSETS ?>js/script.js"></script>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">

                    <div style="margin-bottom: 2%">
                        <span style="color: #00c292; font-size: 20px;"><b><?php echo isset($_REQUEST["message"])?$_REQUEST["message"]:""; ?></b></span>
                    </div>
                    <form  method="post" enctype="multipart/form-data">
                        <div class="row">
                            <label>Register As:</label>
<!--                        <div class="btn-group col">-->
<!---->
<!--                            <input type="radio" class="btn-check radio_user_type" id="chkUser" name="chktype" autocomplete="off"  value="User" checked />-->
<!--                            <label class="btn btn-warning" for="chkUser">Customer</label>-->
<!---->
<!--                            <input type="radio" class="btn-check radio_user_type"  id="chkVendor" name="chktype" value="Vendor" autocomplete="off" />-->
<!--                            <label class="btn btn-warning" for="chkVendor">Vendor</label>-->
<!---->
<!--                        </div>-->
                            <div class="btn-group" data-toggle="buttons">

                                <label class="btn btn-warning active">
                                    <input type="radio" name="chktype" id="chkUser" autocomplete="off" value="User" checked> Customer
                                </label>
                                <label class="btn btn-warning">
                                    <input type="radio" name="chktype" id="chkVendor" autocomplete="off" value="Vendor"> Vendor
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>User Name</label>
                                <input type="text" class="form-control" id="uname" placeholder="User Name" name="uname"
                                       required="required" data-validation-required-message="Please enter your username">
                            </div>
                            <div class="col-sm-6">
                                <label>Phone Number</label>
                                <input type="number" class="form-control" id="uphone" placeholder="Phone Number" name="uphone"
                                       required="required" data-validation-required-message="Please enter your Phone Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" id="uemail" placeholder="Email Address" name="uemail"
                                   required="required" data-validation-required-message="Please enter your Email">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Password</label>
                                <input type="password" class="form-control" id="upass" placeholder="Password" name="upass"
                                       required="required" data-validation-required-message="Please enter your password">
                            </div>
                            <div class="col-sm-6">
                                <label>Confirm Password</label>
                                <input type="text" class="form-control" id="upass2" placeholder="Confirm Password" name="upass2"
                                       required="required" data-validation-required-message="Please retype your password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Aadhar Number</label>
                                <input type="number" class="form-control" id="aadhar" placeholder="Aadhar Number" name="aadhar"
                                       required="required" data-validation-required-message="please enter a valid aadhar number">
                            </div>
                            <div class="col-sm-6">
                                <label>Pancard Number</label>
                                <input type="text" class="form-control" id="pancard" placeholder="Pancard Number" name="pancard"
                                       required="required" data-validation-required-message="please enter a valid pancard number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>GST Number</label>
                                <input type="text" class="form-control" id="gst" placeholder="GST Number" name="gst"
                                       required="required" data-validation-required-message="please enter a valid GST number">
                            </div>
                            <div class="col-sm-6">
                                <label>Current Account Number</label>
                                <input type="text" class="form-control" id="caccountnumber" placeholder="Current Account Number" name="caccountnumber"
                                       required="required" data-validation-required-message="please enter a valid account number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="formFile" class="form-label">Cancel Cheque</label><div id="cancelchequeImagePreview" style="height: 20px; width: 10%; display: none;"></div>
                                <input class="form-control" type="file" name="cancelcheque" id="cancelcheque" onchange="return fileValidation(this.id);">

                            </div>
                            <div class="col-sm-6">
                                <label for="formFile" class="form-label">Photo</label>
                                <input class="form-control" type="file" name="photo" id="photo" onchange="return fileValidation(this.id);">
                                <div id="photoImagePreview" style="height: 20px; width: 10%; display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="formFile" class="form-label">Signature</label>
                                <input class="form-control" type="file"  name="sign" id="sign" onchange="return fileValidation(this.id);">
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
