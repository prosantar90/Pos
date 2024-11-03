<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page_header">
                    <h2>Customer Pay Form </h2>
                    <?php alertMsg();?>
                </div>
                <div class="page-body">
                    <form action="action.php" method="post" id="customer_pay-frm">
                        <div class="card">
                         <div class="card-body">
                            <div class="row" id="get_details">
                                <div id="search__input" class="col-md-4">
                                    <label for="search">Search Customer</label>
                                    <input type="text" name="search_cus" id="search_cus" class="form-control" placeholder="Customer name | Id | Phone" autocomplete="off">
                                    <ul id="result_customer" class="list-group" style="position: absolute; z-index: 1000; display: none;"></ul>
                                </div>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'?>