<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?> 

<!-- Start Main  content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <?php alertMsg();?>
                <div class="card">
                    <div class="card-body">
                <form action="action.php" method="post">
                    <input type="hidden" name="ca_id" value=<?= $cat_id;?>>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cat_name">Category Name</label>
                                <input type="text" class="form-control" name="cat_name" value="<?= $catName;?>"` placeholder="Category Name" required>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <?php 
                                if ($cUpdate == true) {
                                  ?>
                                <input type="submit" class="btn btn-primary mt-4" value="Update" name="update_cat">
                            <?php
                                }else{
                                    ?>
                                     <input type="submit" class="btn btn-primary mt-4" value="Save" name="add_cat">
                                <?php } ?>
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
