<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <?php if (isset($_SESSION['response'])) {
                        ?>
                        <div class="alert alert-<?= $_SESSION['res_type'];?> alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $_SESSION['response'];?>
                        </div>    
                        <?php } unset($_SESSION['response']);?>
                <div class="card">
                    <div class="card-body">
                <form action="action.php" method="post">
                    <input type="hidden" name="u_id" value="<?= $u_id;?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand_name">Unit Name</label>
                                <input type="text" class="form-control" name="unit_name" placeholder="Unit Name" value="<?= $uName;?>" required>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <?php if ($uUpdate == true) { ?>
                                <input type="submit" class="btn btn-primary mt-4" value="Update" name="u_update">
                                <?php } else{?>
                                <input type="submit" class="btn btn-primary mt-4" value="Save" name="save_unit">
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </form>   
                    </div>
                </div>  
              
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'?>