<?php 
require_once 'includes/header.php'; 
require_once 'includes/sidebar.php';
$pur= new Purchase($conn);
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
                                <button type="button" class="btn  btn-primary" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">Add New</button>
                            </div>
                            <div class="card-header-right">
                                <button id="purchase__exportCsv" data-id="export_pu_csv" class="btn btn-default">Export CSV</button>
                                <!-- <button class="btn btn-default">Export PDF</button> -->
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover" id="purchase_list">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Product code</th>
                                            <th>Product Qty</th>
                                            <th>Product Unit</th>
                                            <th>Supplier Name</th>
                                            <th>Date </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
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
<!-- Model Box -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Purchase Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php require_once 'includes/purchase/form.php';?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- View Purchase product -->
<div class="modal" id="pr_view">
    <div class="modal-dialog content-width">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Product Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-bodi" id="purchase_product_view">
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php';?>