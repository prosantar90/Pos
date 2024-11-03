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
                                <button id="salesman__exportCsv" data-id="export_salesman_csv" class="btn btn-default">Export CSV</button>
                                <button id="salesman__importCsv" data-id="import_import_csv" class="btn btn-default">Import CSV</button> 
                            </div>
                            <div class="text-center" id="imort_frm"style="display:none;">
                                <form id="import_csv_form" action="action.php" method="POST" enctype="multipart/form-data" >
                                    <input type="file" name="import_csv_salesMan" id="import_csv_salesMan" accept=".csv">
                                    <input type="submit" value="Submit" class="" name="import_salesMan">
                            </form>
                             </div>  
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover" id="salesManList">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Father Name</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <!-- Here Coming from ajax -->
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
<!-- Model Form Box -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Sales Man Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php require_once 'includes/salesman/form.php';?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- End form box -->

<div class="modal fade bd-example-modal-view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">View Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <div id="man_view_box"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<?php include 'includes/footer.php';?>