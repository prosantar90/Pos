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
                    <!-- card Start -->
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User name</th>
                                        <th>Full Name</th>
                                        <th>User Role</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $uq = "SELECT * FROM users";
                                        $u= $conn->prepare($uq);
                                        $u->execute();
                                        $ur=$u->get_result();
                                        while ($ru = mysqli_fetch_array($ur)) {
                                    ?>
                                    <tr>
                                        <td><?=$ru['id'];?></td>
                                        <td><?=$ru['ufname'];?></td>
                                        <td><?=$ru['user_email'];?></td>
                                        <td><?=$ru['user_role'];?></td>
                                        <td><img src="<?=$ru['u_photo'];?>" alt="<?=$ru['u_photo'];?>" class="rounded"
                                                width="50"></td>
                                        <td>
                                            <?php 
                                            if ($urole == 'admin') {
                                            ?>
                                            <a href="#" class="badge badge-primary p-2"><i
                                                    class="ti-pencil-alt"></i></a>
                                            <a href="#" class="badge badge-primary p-2"><i class="ti-eye"></i></a>
                                            <a href="#" class="badge badge-danger p-2"><i class="ti-trash"></i></a>
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