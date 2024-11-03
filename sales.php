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
                                <button id="sales__exportCsv" data-id="export_sales_csv" class="btn btn-default">Export CSV</button>
                                <!-- <button id="sales__importCsv" data-id="import_import_csv" class="btn btn-default">Import CSV</button> -->

                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover" id="sales_list">
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
<!-- View Customer as a profile -->
<div class="modal" id="sale_view_ajax">
    <div class="modal-dialog content-width">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Sale View</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-bodi" id="sales_views">
               
            </div>
        </div>
    </div>
</div>



<?php require_once 'includes/footer.php'?>