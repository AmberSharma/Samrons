<?php $this->view("samrons/loginheader",$data); ?>

<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form" style="text-align: center">
                <h1 >New User SignUp</h1>
                <div id="success"  ></div>
                <form  method="post" enctype="multipart/form-data">
                    <span>Register AS?</span>
                    <label for="chkUser">
                        <input type="radio" id="chkUser" name="chkType" class="radio_user_type" value="User" />
                        User
                    </label>
                    <label for="chkVendor">
                        <input type="radio" id="chkVendor" name="chkType" class="radio_user_type" value="Vendor"/>
                        Vendor
                    </label>

                    <?php check_error(); ?>
                    <div class="control-group" id="duname">
                        <input type="text" class="form-control" id="uname" placeholder="Username" name="uname"
                               required="required" data-validation-required-message="Please enter your name"  style="text-align: center"/>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" >
                        <input type="text" class="form-control" id="uemail" placeholder="Email" name="uemail"
                               required="required" data-validation-required-message="Please enter your Email"  style="text-align: center"/>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" >
                        <input type="text" class="form-control" id="uphone" placeholder="Phone Number" name="uphone"
                               required="required" data-validation-required-message="Please enter your Mobile Number"  style="text-align: center"/>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" style="text-align: center">
                        <input type="password" class="form-control" id="upass" placeholder="Your Password" name="upass"
                               required="required" data-validation-required-message="Please enter your password" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" style="text-align: center">
                        <input type="password" class="form-control" id="upass2" placeholder="Your Password" name="upass2"
                               required="required" data-validation-required-message="Please retype1234
                                your password" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" style="text-align: center">
                        <input type="text" class="form-control" id="aadhar" placeholder="Aadhar Number" name="aadhar"
                               required="required" data-validation-required-message="please enter a valid aadhar number" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" style="text-align: center">
                        <input type="text" class="form-control" id="pancard" placeholder="Pancard Number" name="pancard"
                               required="required" data-validation-required-message="please enter a valid pancard number" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" style="text-align: center">
                        <input type="text" class="form-control" id="GST" placeholder="GST Number" name="GST"
                               required="required" data-validation-required-message="please enter a valid GST number" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" style="text-align: center" id="dcancelcheque">
                       Cancel Cheque <input type="file" name="cancelcheque" id="cancelcheque" onchange="return fileValidationcheque();">
                        <p class="help-block text-danger"></p>
                        <div id="imagePreviewc" style="height: 20px; width: 10%; display: none;"></div>
                    </div>
                    <div class="control-group" style="text-align: center" id="dphoto">
                       Photo <input type="file" name="photo" id="photo" onchange="return fileValidationphoto();">
                        <p class="help-block text-danger"></p>
                        <div id="imagePreviewp" style="height: 20px; width: 10%; display: none;"></div>
                    </div>
                    <div class="control-group" style="text-align: center" id="dsign">
                       Signature <input type="file" name="sign" id="sign" onchange="return fileValidationsign();">
                        <p class="help-block text-danger"></p>
                        <div id="imagePreviews" style="height: 20px; width: 10%; display: none;"></div>
                    </div>
                    <div class="control-group" style="text-align: center">
                        <input type="text" class="form-control" id="caccountnumber" placeholder="Current Account Number" name="caccountnumber"
                               required="required" data-validation-required-message="please enter a valid account number" />
                        <p class="help-block text-danger"></p>
                    </div>
                   <!-- <div class="control-group">
                        Login As:
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                            <label class="form-check-label" for="inlineRadio1">Customer</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Vendor</label>
                        </div>
                    </div>-->
                    <br>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Sign Up</button>
                        <!--<button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Sign Up</button>-->
                    </div>
                   
                </form>
            </div>
        </div>
        <!-- <div class="col-lg-5 mb-5">
            <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
            <p>Justo sed diam ut sed amet duo amet lorem amet stet sea ipsum, sed duo amet et. Est elitr dolor elitr erat sit sit. Dolor diam et erat clita ipsum justo sed.</p>
            <div class="d-flex flex-column mb-3">
                <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="d-flex flex-column">
                <h5 class="font-weight-semi-bold mb-3">Store 2</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
        </div>
        -->
    </div>
</div>
<!-- Contact End -->

<?php $this->view("samrons/footer"); ?>
