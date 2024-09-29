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
                <form action="action.php" method="post">
                    <!-- Card Start -->
                    <div class="card" id="sales_frm">
                        <div class="card-header p-2">
                            <div class="float-right">
                                <?php 
                               if (get_sales_no() !==0) {?>
                            <h3 class="mb-0">Invoice #<?= get_sales_no()?></h3>
                                <input type="hidden" name="invoice_no" value="<?= get_sales_no()?>">
                               <?php } else {?>
                                <h3 class="mb-0">Invoice #</h3>
                                <input type="hidden" name="invoice_no" value="1">
                               <?php } ?>
                                Date: <?php echo date('d-M-Y');?>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">From:</h5>
                                <h3 class="text-dark mb-1"><?= $fullName;?></h3>
                                <div><?= $uAddress?></div>
                                <div>Email: <?= $uemail?></div>
                                <div>Phone: <?= $uPhone?></div>
                            </div>
                            <div class="col-sm-6 ">
                                <h5 class="mb-3">To:</h5>
                                 <input type="text" class="form-control" name="cum_name" value="<?= isset($_SESSION['form_data']['cum_name']) ? $_SESSION['form_data']['cum_name'] : ''; ?>" placeholder="Customer Name">
                                <input type="text" class="form-control mt-2" name="cum_father" value="<?= isset($_SESSION['form_data']['cum_father']) ? $_SESSION['form_data']['cum_father'] : ''; ?>" placeholder="Father Name">
                                <input type="text" class="form-control mt-2" name="cum_phone" value="<?= isset($_SESSION['form_data']['cum_phone']) ? $_SESSION['form_data']['cum_phone'] : ''; ?>" placeholder="Phone Number">
                                <textarea name="address" id="address" class="form-control mt-2" placeholder="Address"><?= isset($_SESSION['form_data']['address']) ? $_SESSION['form_data']['address'] : ''; ?></textarea>
                            </div>
                        </div>
                   <div class="col-md-12">
                    <!-- Row start for input form  -->
                    <div class="row"> 
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label for="product_name">Product Code</label>
                                    <input type="text" name="pro_code" id="pro_code" class="form-control" placeholder="Product code">
                                </div>
                            </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="pro_name" id="pro_name" class="form-control" disabled>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                          <div class="form-group">
                            <label for="product_price">Product Price</label>
                            <input type="text" name="pro_prce" id="pro_prce" class="form-control" disabled >
                        </div>
                    </div>
                     <div class="col-md-2">
                          <div class="form-group">
                            <label for="product_price">Product QTY</label>
                            <input type="number" name="pro_prce" id="pro_qty" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-2">
                          <div class="form-group">
                            <label for="product_price">Product Total</label>
                            <input type="text" name="pro_prce" id="pro_total" class="form-control" disabled >
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button id="add_row" class="btn btn-primary mt-4">Add</button>
                    </div>
                <!-- Row end -->
                    </div>
                   </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped" id="sales_invoice">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <th class="right">Price</th>
                                        <th class="center">Qty</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="append">
                                   
                                </tbody>
                            </table>

                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">
                            </div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Subtotal</strong>
                                            </td>
                                            <td class="right">
                                                <span class="sub-total"></span>
                                                <input type="hidden" name="sub_total" class="sub-total-hidden">
                                            </td>
                                        </tr>
                                        <tr>
                                         <td class="left">
                                             <strong class="text-dark">Paid Amount</strong>
                                         </td>   
                                          <td class="right">
                                                <input id='paid-amount' type="text" name="paid-amount" class="form-control paid-amount">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Grand Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong id='grand-total_amount' class="text-dark"></strong>
                                                <input type="hidden" name="sales_total_amount" id="sales_grand_total">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <button class="btn btn-success" name="sales_btn">Submit</button>
                    <!-- End Card -->
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php require_once 'includes/footer.php'?>