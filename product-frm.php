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
                        <?php if (isset($_SESSION['response'])) { ?>
                    <div class="alert alert-<?= $_SESSION['res_type'];?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?= $_SESSION['response'];?>
                    </div>    
                    <?php } unset($_SESSION['response']);?>
                   <div class="card">
                    <div class="card-body">
                 <form action="action.php" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="pr_id" value="<?= $pr_id;?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input type="text" class="form-control" placeholder="Product Name" value="<?= $pr_name;?>" name="product_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productCode-">Product Code</label>
                                    <input type="text" class="form-control" placeholder="Product Code" value="<?= $pr_code?>" name="product_code" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand-">Brand</label>

                                    
                                    <select name="brand" id="brand" class="form-control" required>
                                        <option value="" selected="false" disabled="disabled">Select Brand</option>
                                    <?php 
                                        $bq=  "SELECT * FROM brand WHERE brand_status=1";
                                        $br = $conn->prepare($bq);
                                        $br->execute();
                                        $br = $br->get_result();
                                        foreach ($br as  $brow) {
                                        if ( $brow['b_id'] == $br_id ) {
                                              ?>
                                           <option value="<?= $brow['b_id']?>" selected="selected"><?= $brow['brand_name']?></option>
                                        <?php
                                            }
                                           ?>
                                           <option value="<?= $brow['b_id']?>"><?= $brow['brand_name']?></option>
                                    <?php  }  ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Product Category-">Product Category</label>
                                    <select name="p_cat" id="p_cat" class="form-control" required>
                                        <option value="" selected="false" disabled="disabled">Select Category</option>
                                    <?php 
                                        $cq=  "SELECT * FROM categories WHERE cat_status=1";
                                        $cr = $conn->prepare($cq);
                                        $cr->execute();
                                        $cr = $cr->get_result();
                                        foreach ($cr as  $crow) {
                                             if ( $crow['cat_id'] == $pr_cat ) {
                                           ?>
                                           <option value="<?= $crow['cat_id']?>" selected="selected"><?= $crow['category_name']?></option>
                                        <?php }?>
                                           <option value="<?= $crow['cat_id']?>"><?= $crow['category_name']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Salse unit-">Sales Unit</label>
                                    <select name="sales_unit" id="sales_unit" class="form-control" required>
                                        <option value="" selected="false" disabled="disabled">Select unit</option>
                                    <?php 
                                        $cq=  "SELECT * FROM units WHERE unit_status=1";
                                        $cr = $conn->prepare($cq);
                                        $cr->execute();
                                        $cr = $cr->get_result();
                                        foreach ($cr as  $crow) {
                                             if ( $crow['unit_id'] == $pr_unit ) {
                                           ?><option value="<?= $crow['unit_id']?>" selected="selected"><?= $crow['unit_name']?></option>
                                        <?php }?>
                                           <option value="<?= $crow['unit_id']?>"><?= $crow['unit_name']?></option>
                                        <?php }?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Stock Alert-">Stock Alert</label>
                                    <input type="text" class="form-control" value="<?= $pr_stock;?>" placeholder="Product Unt" name="stock_alert" required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price-">Price</label>
                                    <input type="text" class="form-control" value="<?= $pr_price;?>" placeholder="Price" name="price" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity-">Quantity</label>
                                    <input type="text" class="form-control" value="<?= $pr_qty?>" placeholder="Quantity" name="quantity" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="p_image-">Upload product Image</label>
                                    <input type="hidden" name="oldprimg" value="<?= $pr_image?>">
                                    <input type="file" class="custom-file form-control" name="p_image">
                                    <img src="<?= $pr_image;?>" alt="<?= $pr_image;?>" width="100" class="rounded">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php 
                                    if ($pr_update === true) {
                                        ?>
                                    <input type="submit" value="Update Product" class="btn btn-block btn-primary"  name="up_product">
                                    <?php }else{?>
                                    <input type="submit" value="Add Product" class="btn btn-block btn-primary"  name="add_product">
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