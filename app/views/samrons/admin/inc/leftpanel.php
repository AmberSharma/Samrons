<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
<!--                <li class="menu-title">UI elements</li>-->
<!--                <li class="menu-item-has-children dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"-->
<!--                       aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Components</a>-->
<!--                    <ul class="sub-menu children dropdown-menu">-->
<!--                        <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html">Buttons</a></li>-->
<!--                        <li><i class="fa fa-id-badge"></i><a href="ui-badges.html">Badges</a></li>-->
<!--                        <li><i class="fa fa-bars"></i><a href="ui-tabs.html">Tabs</a></li>-->
<!---->
<!--                        <li><i class="fa fa-id-card-o"></i><a href="ui-cards.html">Cards</a></li>-->
<!--                        <li><i class="fa fa-exclamation-triangle"></i><a href="ui-alerts.html">Alerts</a></li>-->
<!--                        <li><i class="fa fa-spinner"></i><a href="ui-progressbar.html">Progress Bars</a></li>-->
<!--                        <li><i class="fa fa-fire"></i><a href="ui-modals.html">Modals</a></li>-->
<!--                        <li><i class="fa fa-book"></i><a href="ui-switches.html">Switches</a></li>-->
<!--                        <li><i class="fa fa-th"></i><a href="grid.php">Grids</a></li>-->
<!--                        <li><i class="fa fa-file-word-o"></i><a href="ui-typgraphy.html">Typography</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="menu-item-has-children active dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"-->
<!--                       aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tables</a>-->
<!--                    <ul class="sub-menu children dropdown-menu">-->
<!--                        <li><i class="fa fa-table"></i><a href="tables-basic.html">Basic Table</a></li>-->
<!--                        <li><i class="fa fa-table"></i><a href="tables-data.html">Data Table</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="menu-item-has-children dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"-->
<!--                       aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>-->
<!--                    <ul class="sub-menu children dropdown-menu">-->
<!--                        <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>-->
<!--                        <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!---->
<!--                <li class="menu-title">Icons</li>-->
<!---->
<!--                <li class="menu-item-has-children dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"-->
<!--                       aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Icons</a>-->
<!--                    <ul class="sub-menu children dropdown-menu">-->
<!--                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Font Awesome</a>-->
<!--                        </li>-->
<!--                        <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Themefy Icons</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="widgets.html"> <i class="menu-icon ti-email"></i>Widgets </a>-->
<!--                </li>-->
<!--                <li class="menu-item-has-children dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"-->
<!--                       aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Charts</a>-->
<!--                    <ul class="sub-menu children dropdown-menu">-->
<!--                        <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-chartjs.html">Chart JS</a></li>-->
<!--                        <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-flot.html">Flot Chart</a></li>-->
<!--                        <li><i class="menu-icon fa fa-pie-chart"></i><a href="charts-peity.html">Peity Chart</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!---->
<!--                <li class="menu-item-has-children dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"-->
<!--                       aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Maps</a>-->
<!--                    <ul class="sub-menu children dropdown-menu">-->
<!--                        <li><i class="menu-icon fa fa-map-o"></i><a href="maps-gmap.html">Google Maps</a></li>-->
<!--                        <li><i class="menu-icon fa fa-street-view"></i><a href="maps-vector.html">Vector Maps</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
                <li class="menu-title">Extras</li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                    <ul class="sub-menu children dropdown-menu">
<!--                        <li><i class="menu-icon fa fa-sign-in"></i><a href="login.php">Login</a></li>-->
<!--                        <li><i class="menu-icon fa fa-sign-in"></i><a href="register.php">Register</a></li>-->
<!--                        <li><i class="menu-icon fa fa-paper-plane"></i><a href="pages-forget.html">Forget Pass</a></li>-->
                        <?php
                            if (isset($_SESSION["type"])  && $_SESSION["type"] == 1) {
                        ?>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="/admin/addNewCategory">Add Category</a></li>
                                <li><i class="menu-icon fa fa-sign-in"></i><a href="/admin/vendorList">Approve Vendors</a></li>
                        <?php
                            } else {
                        ?>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="addProducts">Add Products</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="bulkUploadImages">Bulk Upload Images</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="bulkUploadProducts">Bulk Upload Products</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="viewProducts">View Products</a></li>
                                <li><i class="menu-icon fa fa-sign-in"></i><a href="viewOrders">View Orders</a></li>

                                <?php
                            }
                        ?>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->