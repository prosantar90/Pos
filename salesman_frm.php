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
                    <h3>Salasman form</h3>
                </div>
                <div class="page-body">
                    <?php alertMsg();?>
                    <div class="card">
                        <div class="card-body">
                            <?php require_once 'includes/salesman/form.php';?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'?>