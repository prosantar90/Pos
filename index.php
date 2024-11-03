<?php 
require_once 'includes/header.php'; 
require_once 'includes/sidebar.php';
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'collection-date';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <!-- order-card start -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-c-blue order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Earning</h6>
                                    <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span><?= alTimePurchase();?></span></h2>
                                    <p class="m-b-0">Today Earning<span class="f-right"><?= toDayPurchase();?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Sales</h6>
                                    <h2 class="text-right"><i class="ti-tag f-left"></i><span><?= allTimeSale();?></span></h2>
                                    <p class="m-b-0">This Month<span class="f-right"><?= todaySales();?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total items Recived</h6>
                                    <h2 class="text-right"><i class="ti-reload f-left"></i><span><?= allTimePurchasItems();?></span></h2>
                                    <p class="m-b-0">Today<span class="f-right"><?= toDayPurchasItems();?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-c-pink order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total items Sale</h6>
                                    <h2 class="text-right"><i class="ti-wallet f-left"></i><span><?= alTimeSaleItems();?></span></h2>
                                    <p class="m-b-0">This Month<span class="f-right"><?= toDaySaleItems();?></span></p>
                                </div>
                            </div>
                        </div>
                        <!-- order-card end -->

                        <!-- Customer overview start -->
            <div class="col-lg-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Notification</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <!-- <button type="button" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-more "></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="ti-fullscreen"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul> -->
                            </div>
                        </div>
                       <ul class="nav nav-pills nav-fill mt-3 border-bottom pb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($activeTab == 'collection-date') ? 'active' : ''; ?>" 
                                id="pills-home-tab" 
                                 
                                href="?tab=collection-date" 
                                role="tab" 
                                aria-controls="pills-home" 
                                aria-selected="<?php echo ($activeTab == 'collection-date') ? 'true' : 'false'; ?>">
                                <i class="feather icon-film m-r-5"></i> Collection Date
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($activeTab == 'manage-products') ? 'active' : ''; ?>" 
                                id="pills-profile-tab" 
                                href="?tab=manage-products" 
                                role="tab" 
                                aria-controls="pills-profile" 
                                aria-selected="<?php echo ($activeTab == 'manage-products') ? 'true' : 'false'; ?>">
                                <i class="feather icon-file-text m-r-5"></i> Manage Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($activeTab == 'recent-customers') ? 'active' : ''; ?>" 
                                id="pills-contact-tab" 
                                 
                                href="?tab=recent-customers" 
                                role="tab" 
                                aria-controls="pills-contact" 
                                aria-selected="<?php echo ($activeTab == 'recent-customers') ? 'true' : 'false'; ?>">
                                <i class="feather icon-mail m-r-5"></i> Recent Customers
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade <?php echo ($activeTab == 'collection-date') ? 'show active' : ''; ?>" 
                                id="pills-home" 
                                role="tabpanel" 
                                aria-labelledby="pills-home-tab">
                                <?php require_once 'includes/home/collection-due.php'; ?>
                            </div>

                            <div class="tab-pane fade <?php echo ($activeTab == 'manage-products') ? 'show active' : ''; ?>" 
                                id="pills-profile" 
                                role="tabpanel" 
                                aria-labelledby="pills-profile-tab">
                                <?php require_once 'includes/home/manage-products.php'; ?>
                            </div>
                            
                            <div class="tab-pane fade <?php echo ($activeTab == 'recent-customers') ? 'show active' : ''; ?>" 
                                id="pills-contact" 
                                role="tabpanel" 
                                aria-labelledby="pills-contact-tab">
                                <?php require_once 'includes/home/recents-customers.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Customer overview end -->    
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recived Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="toolbar btn-group">
                                        <button id="one_monthP" class="btn btn-sm btn-outline-primary">1M</button>
                                        <button id="six_monthsP" class="btn btn-sm btn-outline-primary">6M</button>
                                        <button id="one_yearP" class="btn btn-sm btn-outline-primary active">1Y</button>
                                        <button id="ytdP" class="btn btn-sm btn-outline-primary">YTD</button>
                                        <button id="allP" class="btn btn-sm btn-outline-primary">ALL</button>
                                    </div>
                                    <div id="purchase_data"></div>
                                </div>
                            </div>
                        </div>

                        <!-- statustic and process start -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Sales</h5>
                                </div>
                                <div class="card-body">
                                    <div class="toolbar btn-group">
                                        <button id="one_monthS" class="btn btn-sm btn-outline-primary">1M</button>
                                        <button id="six_monthsS" class="btn btn-sm btn-outline-primary">6M</button>
                                        <button id="one_yearS" class="btn btn-sm btn-outline-primary active">1Y</button>
                                        <button id="ytdS" class="btn btn-sm btn-outline-primary">YTD</button>
                                        <button id="allS" class="btn btn-sm btn-outline-primary">ALL</button>
                                    </div>
                                    <div id="sales-data"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="styleSelector">
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center" id="footer">
        <a href="#" class="text-center">❤️ Powered By Prosanta ❤️</a>
    </footer>
</div>
<!-- End Main content -->
<?php include 'includes/footer.php';?>