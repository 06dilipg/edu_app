<?php
?>

<!-- Side Nav START -->
<div class="side-nav expand-lg">
<div class="side-nav-inner">
<ul class="side-nav-menu scrollable">
<li class="side-nav-header">
    <span>MENU</span>
</li>




    <li class="nav-item">
        <a class="dropdown-toggle" href="<?php echo base_url('index.php/dashboard');?>">
                                <span class="icon-holder">
                                    <i class="mdi mdi-gauge"></i>
                                </span>
            <span class="title">Dashboard</span>

        </a>



    <li class="side-nav-header">
        <span>Others</span>
    </li>
    <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="mdi mdi-image-filter-tilt-shift"></i>
                                </span>
            <span class="title">Extra</span>
                                <span class="arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>
        </a>
        <ul class="dropdown-menu">
           
            <li>
                <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="mdi mdi-clipboard-check"></i>
                                </span>
                    <span class="title">Inventory</span>
                                <span class="arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>

                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="mdi mdi-cart"></i>
                                </span>
                            <span class="title">Purchase</span>
                                <span class="arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url("index.php/manageInventory")?>">Add Product</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("index.php/addPurchase")?>">Add Purchase</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("index.php/listPurchase")?>">List Purchase</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="mdi mdi-stocking"></i>
                                </span>
                            <span class="title">Stock</span>
                                <span class="arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>

                        </a>
                        <ul class="dropdown-menu">
                           <!--  <li>
                                <a href="<?php echo base_url("index.php/addStock")?>">Add Stock</a>
                            </li> -->
                            <li>
                                <a href="<?php echo base_url("index.php/listStock")?>">Stock List</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("index.php/outStock")?>">Stock Out</a>
                            </li>
                             <li>
                                <a href="<?php echo base_url("index.php/outstockList")?>">Stock Out List</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="mdi mdi-library"></i>
                                </span>
                    <span class="title">Library</span>
                                <span class="arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>

                </a>

            </li>

        </ul>
    </li>







</ul>
</div>
</div>
<!-- Side Nav END -->


<!-- Page Container START -->
<div class="page-container">


