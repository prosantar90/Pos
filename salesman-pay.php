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
                    <h2>Sales Man Pay Form </h2>
                    <?php alertMsg();?>
                </div>
                <div class="page-body">
                    <form action="action.php" method="post" id="salesMan_pay-frm">
                        <div class="card">
                         <div class="card-body">
                            <div class="row" id="get_details">
                                <div id="search__input" class="col-md-4">
                                    <label for="search">Search sales man</label>
                                    <?php 
                                    $salsman = new Salesman($conn);
                                    $salemans= $salsman->getAllSaleMans();
                                    ?>

                                <select name="salesman" id="selected_salsman" class="form-control select1">
                                    <option value="">Select Sales Man</option>
                                    <?php foreach ($salemans as $man) {
                                        echo '<option value="'.$man['ID'].'">'.$man['salesman_name'].'</option>';
                                    }?>
                                </select>
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