
<?php 
require_once 'includes/header.php'; 
require_once 'includes/sidebar.php';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <?php alertMsg();?>
                    <!-- Hover table card start -->
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-12">
                                <a href="purchase-frm.php" class="btn btn-primary">Add new</a>
                            </div>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa-chevron-left"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-times close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover" id="purchase_list">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Unit</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <!-- <th>Status</th> -->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $q = "SELECT products.product_id, products.product_name, products.product_code, brand.brand_name, units.unit_name, categories.category_name, products.price,products.quantity, products.p_image FROM products 
                                            LEFT JOIN brand ON products.brand= brand.b_id
                                            LEFT JOIN units ON products.sales_unit= units.unit_id
                                            LEFT JOIN categories ON products.p_cat= categories.cat_id ";
                                            $p = $conn->prepare($q);
                                            $p->execute();
                                            $r = $p->get_result();
                                            while($row= mysqli_fetch_array($r)){
                                            ?>
                                        <tr>
                                            <th scope="row"><?= $row['product_id'];?></th>
                                            <td><img src="<?= $row['p_image'];?>" alt="<?= $row['p_image'];?>"
                                                    class="rounded" width="50"></td>
                                            <td><?= $row['product_name']?></td>
                                            <td><?= $row['product_code']?></td>
                                            <td><?= $row['category_name']?></td>
                                            <td><?= $row['brand_name'];?></td>
                                            <td><?= $row['unit_name']?></td>
                                            <td><?= $row['quantity'];?></td>
                                            <td><?= $row['price'];?></td>
                                            <td>
                                                <?php 
                                                if ($urole == 'admin') {
                                                ?>
                                                <a href="product-frm.php?p_view=<?= $row['product_id'];?>"
                                                    class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
                                                <a href="javascript:void();" id="pro_view"
                                                    class="badge badge-primary p-2" data-id=<?= $row['product_id']?> data-toggle="modal" data-target="#pr_view"><i class="ti-eye"></i></a>
                                                <a href="action.php?p_delete=<?= $row['product_id'];?>" onclick="return delete_alert();"
                                                    class="badge badge-danger p-2"><i class="ti-trash"></i></a>
                                            <?php 
                                                    }else{
                                                    ?>
                                                <a href="action.php?p_view=<?= $row['product_id'];?>"
                                                    class="badge badge-primary p-2">View</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Hover table card end -->
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>
<!-- End Main content -->
<!-- Model Box -->
<!-- Button to Open the Modal -->
<!-- The Modal -->
<div class="modal" id="pr_view">
  <div class="modal-dialog content-width">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-center">Product Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="view_pro">
            <div class="view_pro text-center" >
            <img src="" id="pr_img" width="300" class="rounded">
            </div>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th>Qty</th>
                </tr>
                <tr>
                    <td id="name"></td>
                    <td id="code"></td>
                    <td id="price"></td>
                    <td id="qty"></td>
                </tr>
            </table>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php include 'includes/footer.php';?>