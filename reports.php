<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'today';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page header -->
                     <div class="page-header">
                        <h3>All reports</h3>
                     </div>
                     <!-- End Page header -->
                    <div class="page-body">
                        <div class="card">
                           <div class="card-body">
						<div class="row">
							<div class="col-md-3 col-sm-12">
								
                                <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <li><a class="nav-link text-left <?php echo ($activeTab == 'today') ? 'active' : ''; ?>" id="v-pills-home-tab" href="?tab=today" role="tab" aria-controls="v-pills-home" aria-selected="<?php echo ($activeTab == 'today') ? 'true' : 'false'; ?>">Today</a></li>
                                    <li><a class="nav-link text-left <?php echo ($activeTab == 'weekly') ? 'active' : ''; ?>" id="v-pills-profile-tab" href="?tab=weekly" role="tab" aria-controls="v-pills-profile" aria-selected="<?php echo ($activeTab == 'weekly') ? 'true' : 'false'; ?>">Weekly</a></li>
                                    <li><a class="nav-link text-left <?php echo ($activeTab == 'monthly') ? 'active' : ''; ?>" id="v-pills-messages-tab" href="?tab=monthly" role="tab" aria-controls="v-pills-messages" aria-selected="<?php echo ($activeTab == 'monthly') ? 'true' : 'false'; ?>">Monthly</a></li>
                                    <li><a class="nav-link text-left <?php echo ($activeTab == 'yearly') ? 'active' : ''; ?>" id="v-pills-settings-tab" href="?tab=yearly" role="tab" aria-controls="v-pills-settings" aria-selected="<?php echo ($activeTab == 'yearly') ? 'true' : 'false'; ?>">Yearly</a></li>
                                    <li><a class="nav-link text-left <?php echo ($activeTab == 'custom-date') ? 'active' : ''; ?>" id="v-pills-settings-tab" href="?tab=custom-date" role="tab" aria-controls="v-pills-settings" aria-selected="<?php echo ($activeTab == 'custom-date') ? 'true' : 'false'; ?>">custom-date</a></li>
                                </ul>
							</div>
							<div class="col-md-9 col-sm-12">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade <?php echo ($activeTab == 'today') ? 'show active' : ''; ?>" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            <?php require_once 'includes/reports/deaily.php';?>    
                                        </div>
                                        <div class="tab-pane fade <?php echo ($activeTab == 'weekly') ? 'show active' : ''; ?>" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <?php require_once 'includes/reports/weekly.php'; ?>
                                        </div>
                                        <div class="tab-pane fade <?php echo ($activeTab == 'monthly') ? 'show active' : ''; ?>" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                            <?php require_once 'includes/reports/monthly.php';?>
                                        </div>
                                        <div class="tab-pane fade <?php echo ($activeTab == 'yearly') ? 'show active' : ''; ?>" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                        <?php require_once 'includes/reports/yearly.php';?>

                                        </div>
                                         <div class="tab-pane fade <?php echo ($activeTab == 'custom-date') ? 'show active' : ''; ?>" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                            <?php require_once 'includes/reports/custom-date.php';?>
                                        </div>
                                    </div>
							</div>
						</div>
					</div>
                        </div>
                        
                    </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'?>