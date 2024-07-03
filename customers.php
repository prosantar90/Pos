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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $query = "SELECT * FROM  customers";
                            $getCustomers= getData($query);
                        foreach ($getCustomers as $customer):
                            ?>
                            <tr>
                                <td><?= $customer['cum_id'];?></td>
                                <td><?= $customer['customer_name'];?></td>
                                <td><?= $customer['father_name'];?></td>
                                <td><?= $customer['customer_address'];?></td>
                                <td><?= $customer['phone_number'];?></td>
                                <td><?= $customer['order_amount'];?></td>
                                <td><?= $customer['order_total_amount_due'];?></td>
                                <td>
                                    <a href="#" class="badge badge-primary p-2">Edit</a>
                                    <a href="#" class="badge badge-danger p-2">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php' ?>