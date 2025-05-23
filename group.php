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
                                <a href="group_frm.php" class="btn btn-primary">Add new group</a>
                            </div>
                            <div class="card-header-right">
                                <button id="group__exportCsv" data-id="group__exportCsv"
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
                     <table class="table table-hover" id="groups">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Group Name</th>
                                <th>Aadhaar No</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Register Date</th>
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
<div class="modal" id="group_view_ajax">
    <div class="modal-dialog content-width">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Group View</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-bodi" id="group_view">
               <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Father Name</th>
                        <th>Aadhar No</th>
                        <th>Phone No</th>
                        <th>Addrress</th>
                    </thead>
                    <tbody id="group_views">

                    </tbody>
               </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php' ?>