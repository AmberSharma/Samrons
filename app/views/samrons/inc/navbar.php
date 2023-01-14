<div class="navbar-nav w-100" style="height: 410px; overflow-y: scroll;">
    <?php
    if(!empty($data["category_subcategory"])) {
        foreach($data["category_subcategory"] as $key => $value) {
            if (!empty($value["child"])) {
                ?>
                <div class="nav-item dropdown">
                    <div class="nav-link">
                        <a href="/shop/searchByCategory/<?php echo $value['id'] ?>" style="text-decoration: none;"><?php echo $value["name"] ?></a>
                        <i class="fa fa-angle-down float-right mt-1" data-toggle="dropdown"></i>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <?php
                            foreach($value["child"] as $key1 => $value1) {
                                ?>
                                <a href="/shop/searchByCategory/<?php echo $value1['id'] ?>" class="dropdown-item"><?php echo $value1["name"] ?></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <a href="/shop/searchByCategory/<?php echo $value['id'] ?>" class="nav-item nav-link"><?php echo $value["name"] ?></a>
                <?php
            }
        }
    }
    ?>

    <!--                      <a href="" class="nav-item nav-link">Shirts</a>-->
    <!--                      <a href="" class="nav-item nav-link">Jeans</a>-->
    <!--                      <a href="" class="nav-item nav-link">Swimwear</a>-->
    <!--                      <a href="" class="nav-item nav-link">Sleepwear</a>-->
    <!--                      <a href="" class="nav-item nav-link">Sportswear</a>-->
    <!--                      <a href="" class="nav-item nav-link">Jumpsuits</a>-->
    <!--                      <a href="" class="nav-item nav-link">Blazers</a>-->
    <!--                      <a href="" class="nav-item nav-link">Jackets</a>-->
    <!--                      <a href="" class="nav-item nav-link">Shoes</a>-->
    <!--                      <a href="" class="nav-item nav-link">Jumpsuits</a>-->
    <!--                      <a href="" class="nav-item nav-link">Blazers</a>-->
    <!--                      <a href="" class="nav-item nav-link">Jackets</a>-->
    <!--                      <a href="" class="nav-item nav-link">Shoes</a>-->
</div>