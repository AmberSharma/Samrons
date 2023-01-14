<div class="row bg-secondary py-2 px-xl-5">
    <div class="col-lg-6 d-none d-lg-block">
        <!--              <div class="d-inline-flex align-items-center">-->
        <!--                  <a class="text-dark" href="">FAQs</a>-->
        <!--                  <span class="text-muted px-2">|</span>-->
        <!--                  <a class="text-dark" href="">Help</a>-->
        <!--                  <span class="text-muted px-2">|</span>-->
        <!--                  <a class="text-dark" href="">Support</a>-->
        <!--                  <span class="text-muted px-2">|</span>-->
        <!---->
        <!---->
        <!--              </div>-->
    </div>
    <div class="col-lg-6 text-center text-lg-right">
        <div class="d-inline-flex align-items-center">
            <!--                  <a class="text-dark px-2" href="">-->
            <!--                      <i class="fab fa-facebook-f"></i>-->
            <!--                  </a>-->
            <!--                  <a class="text-dark px-2" href="">-->
            <!--                      <i class="fab fa-twitter"></i>-->
            <!--                  </a>-->
            <!--                  <a class="text-dark px-2" href="">-->
            <!--                      <i class="fab fa-linkedin-in"></i>-->
            <!--                  </a>-->
            <!--                  <a class="text-dark px-2" href="">-->
            <!--                      <i class="fab fa-instagram"></i>-->
            <!--                  </a>-->
            <!--                  <a class="text-dark pl-2" href="">-->
            <!--                      <i class="fab fa-youtube"></i>-->
            <!--                  </a>-->

            <?php
            if(isset( $_SESSION['name']) ) { ?>
                <b style="font: 25px">Welcome  <?php echo $_SESSION["name"] ?></b>
                <a href="/logout" class="nav-item nav-link">Logout</a>
            <?php } else {?>
                <a href="/login" class="nav-item nav-link">Login</a>
                <a href="/signup" class="nav-item nav-link">Register</a>
            <?php }?>
        </div>
    </div>
</div>