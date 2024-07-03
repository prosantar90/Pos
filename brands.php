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
                    <?php if (isset($_SESSION['response'])) { ?>
                    <div class="alert alert-<?= $_SESSION['res_type'];?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?= $_SESSION['response'];?>
                    </div>
                    <?php } unset($_SESSION['response']);?>
                         <!-- Hover table card start -->
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-12">
                                <a href="brand-frm.php" class="btn btn-primary">Add new</a>
                            </div>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa-chevron-left"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-times close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Brand Name</th>
                                                <th>Brand Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $q ="SELECT * FROM brand";
                                                $r= $conn->prepare($q);
                                                $r->execute();
                                                $c = $r->get_result();
                                                while($row=mysqli_fetch_array($c)){
                                                ?>
                                            <tr>
                                                <td><?= $row['b_id'];?></td>
                                                <td><?= $row['brand_name'];?></td>
                                                <td>
                                                    <?php if ($row['brand_status'] == '1') {
                                            ?>
                                            <a class="label label-success" href="action.php?b_id=<?= $row['b_id'];?>&status=0">Active</a>
                                            <?php }else{?>
                                            <a class="label label-danger" href="action.php?b_id=<?= $row['b_id'];?>&status=1">Deactive</a>
                                            <?php }?>
                                                </td>
                                                <td>
                                                 <?php 
                                                if ($urole == 'admin') {
                                                ?>
                                                <a href="brand-frm.php?b_view=<?= $row['b_id'];?>" class="badge badge-primary p-2"><i class="ti-pencil-alt"></i></a>
                                                <a href="action.php?b_delete=<?=$row['b_id']; ?>" onclick="return delete_alert();" class="badge badge-danger p-2"><i class="ti-trash"></i></a>
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
                    </div>
                    <!-- Hover table card end -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'?>