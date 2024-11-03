<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
$users = new Users($conn);
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- card Start -->
                    <div class="card">
                       <div class="card-header">
                            <div class="col-md-12">
                                <a href="user_frm.php" class="btn btn-primary">Add new</a>
                            </div>
                            <div class="card-header-right">
                                <button id="products__exportCsv" data-id="export_products_csv"
                                    class="btn btn-default">Export CSV</button>
                                <button class="btn btn-default">Export PDF</button>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-hover" id="users_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>User Email</th>
                                        <th>User Role</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $users = $users->getAllUsers();
                                        foreach ($users as $ru) {
                                    ?>
                                    <tr>
                                        <td><?=$ru['id'];?></td>
                                        <td><?=$ru['user_name'];?></td>
                                        <td><?=$ru['ufname'];?></td>
                                        <td><?=$ru['user_email'];?></td>
                                        <td><?=$ru['user_role'];?></td>
                                        <td><img src="<?=$ru['u_photo'];?>" alt="<?=$ru['u_photo'];?>" class="rounded"
                                                width="50"></td>
                                        <td>
                                            <?php 
                                            if ($urole == 'admin') {
                                            ?>
                                                <a href="user_frm.php?user_id=<?= $ru['id'];?>" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
                                                <!-- <a href="#" class="badge badge-primary p-2"><i class="ti-eye"></i></a> -->
                                                <?php if($user_name !== $ru['user_name']){?>
                                                <a href="javascript:void(0);" id="delete_user" data-id="<?= $ru['id'];?>" class="badge badge-danger p-2"><i class="ti-trash"></i></a>
                                                    <?php }?>
                                            <?php 
                                            }else{
                                            ?>
                                            <a href="#" class="badge badge-primary p-2">View</a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Card end -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'?>