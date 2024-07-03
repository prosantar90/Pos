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
                    <?php alertMsg();?>
                      <!-- Hover table card start -->
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-12">
                               <a href="sales-frm.php" class="btn btn-primary">Add new</a>
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
                                <table class="table table-hover">
                                     <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Customer name</th>
                                        <th>Total QTY</th>
                                        <th>Total Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php 
                                    $sales =getSales();
                                    foreach ($sales as  $sale) {
                                    ?>
                                <tr>
                                    <td><?= $sale['customer_id'];?></td>
                                    <td><?= $sale['customer_name'];?></td>
                                    <td><?= $sale['qty'];?></td>
                                    <td><?= $sale['total'];?></td>
                                    <td>12 jan 23</td>
                                    <td>
                                    <?php 
                                        if ($urole == 'admin') {
                                        ?>
                                        <a href="brand-frm.php?b_view=<?= $sale['customer_id'];?>" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
                                        <a href="action.php?b_delete=<?=$sale['customer_id']; ?>" onclick="return delete_alert();" class="badge badge-danger p-2"><i class="ti-trash"></i></a>
                                            <?php 
                                        }else{
                                        ?>
                                        <a href="#" class="badge badge-primary p-2">View</a>
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
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'?>