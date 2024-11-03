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
                                <a href="product-frm.php" class="btn btn-primary">Add new</a>
                            </div>
                            <div class="card-header-right">
                                <button id="products__exportCsv" data-id="export_products_csv"
                                    class="btn btn-default">Export CSV</button>
                                <button id="products__importCsv" data-id="import_products_csv" class="btn btn-default">Import CSV</button>
                            </div>
                             <div class="text-center" id="imort_frm"style="display:none;">
                                <form id="import_csv_form" action="action.php" method="POST" enctype="multipart/form-data" >
                                    <input type="file" name="import_csv_product" id="import_csv_product" accept=".csv">
                                    <input type="submit" value="Submit" name="import_products">
                            </form>
                             </div>
                        </div>
                        <div class="card-block table-border-style">
                               <table class="table table-hover" id="products">
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
                                    <tbody></tbody>
                                </table>
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
                <div class="view_pro text-center">
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