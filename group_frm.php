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
                    <?php if($customer_update === true){?>
                        <h2>Update Group </h2>
                        <?php }else{?>
                        <h2>Group Form</h2>
                    <?php }?>
                    <?php alertMsg();?>
                </div>
                <div class="page-body">
                    <form action="action.php" method="post" id="group_frm">
                        <div class="card">
                         <div class="card-body">
                      
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="Adhar">Group Name</label>
                                         <input type="text" class="form-control" placeholder="Group name." name="group_name">
                                    </div>
                                </div>
                                    <div class="col-md-6">
                                        <label for="name">Addhar</label>
                                        <input type="text" name="group_aadhar" class="form-control" placeholder="Enter name" required>
                                    </div>

                                     <div class="col-md-6">
                                        <label for="name">Phone Number</label>
                                        <input type="text" name="group_phone" class="form-control" placeholder="Enter phone number" required>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="name">Address</label>
                                      <textarea name="group_address" id="group_addres" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" id="" name="add_group" value="Add new Group" class="btn btn-block btn-primary mt-2">
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