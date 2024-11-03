<?php 
require_once 'includes/header.php'; 
require_once 'includes/sidebar.php';
$supper =new Supplier($conn);
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <?= alertMsg()?>
                    <!-- Hover table card start -->
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-12">
                                <button type="button" class="btn  btn-primary" data-toggle="modal"
                                    data-target=".bd-example-modal-md">Add New</button>
                            </div>
                            <div class="card-header-right">
                                <button id="supplier__exportCsv" data-id="supplier__exportCsv"
                                    class="btn btn-default">Export CSV</button>
                                <button id="supplier__importCsv" data-id="import_import_csv" class="btn btn-default">Import CSV</button>
                            </div>
                             <div class="text-center" id="imort_frm"style="display:none;">
                                <form id="import_csv_form" action="action.php" method="POST" enctype="multipart/form-data" >
                                    <input type="file" name="import_csv_supplier" id="import_csv_supplier" accept=".csv">
                                    <input type="submit" value="Submit" class="" name="import_supplier">
                            </form>
                             </div>

                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover" id="supplier_list">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Supplier Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Total Amount</th>
                                            <th>Advance Amount</th>
                                            <th>Due Amount</th>
                                            <th>Supplier Status</th>
                                            <th>Actions</th>
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
<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Supplier Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php require_once 'includes/supplier/form.php';?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<div class="modal" id="sup_view">
    <div class="modal-dialog content-width">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Suppllier View</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-bodi" id="supplier_viewAjax">
               
            </div>
        </div>
    </div>
</div>




<?php include 'includes/footer.php';?>