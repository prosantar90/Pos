<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
            <div class="page-header">
                <h4>Purchase Form</h4>
            </div>
                <div class="page-body">
                    <?php echo alertMsg();?>
                    <div class="card">
                        <div class="card-body">
                            <?php require_once 'includes/purchase/form.php';?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'?>