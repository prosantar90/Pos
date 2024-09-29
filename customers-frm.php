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
                    <h2>Add Customer Form</h2>
                    <?php alertMsg();?>
                </div>
                <div class="page-body">
                    <form action="action.php" method="post" id="customer_frm">
                        <div class="card">
                         <div class="card-body">
                        <?php 
                            if ($customer_update === true) {?>
                                <input type="hidden" name="cus_id" value="<?= $cus_id;?>">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="cum_name" value="<?= $cus_name;?>" class="form-control" placeholder="Enter name" required >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Father name</label>
                                        <input type="text" name="cum_father_name" value="<?= $cus_f_name;?>" class="form-control" placeholder="Enter fathar name" required>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="name">Phone Number</label>
                                        <input type="text" name="cum_phone" value="<?= $cus_phone;?>" class="form-control" placeholder="Enter phone number" required>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="name">Address</label>
                                      <textarea name="cus_address" id="cum_addres" class="form-control"><?= $cus_address; ?></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="name">Total Amount</label>
                                        <input type="text" class="form-control" value="<?= $cus_amount?>" disabled>
                                        <input type="hidden" name="cus_t_amount" value="<?= $cus_amount;?>"> 
                                    </div>
                                     <div class="col-md-6">
                                        <label for="name">Paid Amount</label>
                                        <input type="text" class="form-control" name="cus_amount_paid" value="<?= $cus_amount_paid?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Due Amount</label>
                                        <input type="text" class="form-control" name="cus_due_amount" value="<?= $cus_amount_due?>">
                                    </div>
                                   


                                    <div class="col-md-12 mt-3">
                                        <input type="submit" id="" name="update_customer" value="Update Customer" class="btn btn-block btn-primary">
                                    </div>
                                </div>
                            <?php
                               
                            }else{
                        ?>
                               <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="cum_name" class="form-control" placeholder="Enter name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Father name</label>
                                        <input type="text" name="cum_father_name" class="form-control" placeholder="Enter fathar name" required>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="name">Phone Number</label>
                                        <input type="text" name="cum_phone" class="form-control" placeholder="Enter phone number" required>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="name">Address</label>
                                      <textarea name="cus_address" id="cum_addres" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" id="" name="add_customer" value="Add Customer" class="btn btn-block btn-primary">
                                    </div>
                                </div>

                        <?php }?>
                 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'?>