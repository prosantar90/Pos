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
                <div class="card">
                    <div class="card-header">
                            <div class="col-md-12">
                                <a href="customers-frm.php" class="btn btn-primary">Add new</a>
                            </div>
                            <div class="card-header-right">
                                <button id="sales__exportCsv" data-id="sales__exportCsv"
                                    class="btn btn-default">Export CSV</button>
                                <button id="customer__importCsv" data-id="import_import_csv" class="btn btn-default">Import CSV</button>
                            </div>
                             <div class="text-center" id="imort_frm"style="display:none;">
                                <form id="import_csv_form" action="action.php" method="POST" enctype="multipart/form-data" >
                                    <input type="file" name="import_csv_customers" id="import_csv_customers" accept=".csv">
                                    <input type="submit" value="Submit" class="" name="import_customers">
                            </form>
                             </div>
                        </div>
                <div class="card-body">
                     <table class="table table-hover" id="customers_lists">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Total Amount</th>
                                <th>Due Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- View Customer as a profile -->
<div class="modal" id="cust_view_ajax">
    <div class="modal-dialog content-width">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Customer View</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-bodi" id="customer_views">
               
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php' ?>