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
                        <div class="alert alert-danger">
                            <strong>Error! </strong> <?php echo $_REQUEST["message"]; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <form method="post">
                        <div class="row">
                            <label>Login As:</label>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check user_type" name="chktype" id="chkUser" value="User" autocomplete="off">
                                <label class="btn btn-outline-warning" for="chkUser">Customer</label>

                                <input type="radio" class="btn-check user_type" name="chktype" id="chkVendor" value="Vendor" autocomplete="off" checked>
                                <label class="btn btn-outline-warning" for="chkVendor">Vendor</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email/Phone</label>
                            <input type="text" class="form-control" id="lemail" placeholder="Email Address/Phone Number"
                                   required="required" data-validation-required-message="Please enter your email" name="ulemail">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="lpass" placeholder="Your Password"
                                   required="required" data-validation-required-message="Please enter your password" name="ulpass">
                        </div>
<!--                        <div class="checkbox">-->
<!--                            <label>-->
<!--                                <input type="checkbox"> Remember Me-->
<!--                            </label>-->
<!--                            <label class="pull-right">-->
<!--                                <a href="#">Forgotten Password?</a>-->
<!--                            </label>-->
<!---->
<!--                        </div>-->
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" style="margin-top: 5%">Sign in</button>
<!--                        <div class="social-login-content">-->
<!--                            <div class="social-button">-->
<!--                                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>-->
<!--                                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="register-link m-t-15 text-center" >
                            <p>Don't have account ? <a href="signup"> Sign Up Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>
</html>
