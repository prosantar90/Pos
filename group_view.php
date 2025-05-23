<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
$customer = new customers($conn);
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
                            <h2 class="text-center"><?= $samiti_name;?></h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Father Name</th>
                                    <th>Aadhar No</th>
                                    <th>Phone No</th>
                                    <th>Address</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    $groupId = $samiti_id;
                                    $run = $customer->getGroupId($groupId);
                                    if (!empty($run)) {
                                    $no = 1;
                                    foreach ($run as $row) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['customer_name'] ?></td>
                                            <td><?= $row['father_name'] ?></td>
                                            <td><?= $row['aadhaar_no'] ?></td>
                                            <td><?= $row['phone_number'] ?></td>
                                            <td><?= $row['customer_address'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "No Customer added yet";
                                }
                                    ?>                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button class="btn btn-primary" data-target="#new_cus" data-toggle="modal">+ Add New Customer</button>
                </div>
            </div> <!-- End Page wrapper --=== -->
        </div>
    </div>
</div> <!-- End Main content --=== -->

<div class="modal" id="new_cus">
    <div class="modal-dialog content-width">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Add Customer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-bodi" id="">
             <div class="col-12">
                  <form action="" method="post" id="customer">
                    <input type="hidden" name="samiti_id" value="<?= $samiti_id;?>" >
                      <div class="form-group">
                              <select name="select_customer" class="select1" id="">
                                  <option value="">Select one</option>
                                    <?php 
                                    $cus= $customer->getAllCustomers();
                                    foreach ($cus as $c) {
                                        echo '<option value="'.$c['cum_id'].'">'.$c['customer_name'].'</option>';
                                    }
                                    ?>
                              </select>
                      </div>
                      <div class="form-group">
                          <input type="submit" class="btn btn-block btn-primary" value="ADD" name="add_customer_to_group">

                      </div>
               </form>
             </div>
            </div>
        </div>
    </div>
</div>



<?php require_once 'includes/footer.php' ?>