<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
include 'config/config.php';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <?php alertMsg();?>
                   <?php require_once 'includes/sales/sales-frm.php'; ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?php require_once 'includes/footer.php'?>