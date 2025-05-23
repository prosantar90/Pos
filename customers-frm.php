<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
$samiti = new samiti_group($conn);
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page_header">
                    <?php if($customer_update === true){?>
                        <h2>Update Customer </h2>
                        <?php }else{?>
                        <h2>Add Customer Form</h2>
                    <?php }?>
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
                                        <div class="form-group">
                                            <label for="aadhar">Aadhar</label>
                                            <input type="text" name="aadhar_no" class="form-control" value="<?= $cus_aadhar?>" placeholder="Aadhar no">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="cum_name" value="<?= $cus_name;?>" class="form-control" placeholder="Enter name" required >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Father name</label>
                                        <input type="text" name="cum_father_name" value="<?= $cus_f_name;?>" class="form-control" placeholder="Enter fathar name" required>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Phone Number</label>
                                        <input type="text" name="cum_phone" value="<?= $cus_phone;?>" class="form-control" placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <textarea name="cus_address" id="cum_addres" class="form-control"><?= $cus_address; ?></textarea>
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                           <div class="form-group">
                                            <label for="samiti_name">Samiti Name</label>
                                           <select name="samiti_name" id="samiti_name" class="form-control select1">
                                            <option value="0">Select One</option>
                                            <?php 
                                                $samiti_groups = $samiti->getAllGroups();
                                                foreach ($samiti_groups as $s) {
                                                    $selected = ($samiti_id == $s['id']) ? 'selected' : '';
                                                    echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['group_name'].'</option>';
                                                }  
                                            ?>
                                        </select>

                                           </div>
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
                                    <div class="form-group">
                                         <label for="Adhar">Aadhaar Card No</label>
                                         <input type="number" class="form-control" placeholder="Aadhaar No." name="cus_addhar" required>
                                    </div>
                                </div>
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
                                    <div class="col-md-6">
                                        <label for="groupName">Samiti Name</label>
                                        <select name="samitiName" id="samiti_name" class="select1 form-control">
                                            <option value="0">Select One</option>
                                            <?php 
                                            $samiti_groups = $samiti->getAllGroups();
                                                foreach ($samiti_groups as $s) {
                                                    echo '<option value="'.$s['id'].'">'.$s['group_name'].'</option>';
                                                }
                                            ?>
                                        </select>
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