<?php 
require_once 'includes/header.php'; 
require_once 'includes/sidebar.php';
require_once 'session.php';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                         <?php if (isset($_SESSION['response'])) {
                        ?>
                        <div class="alert alert-<?= $_SESSION['res_type'];?> alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $_SESSION['response'];?>
                        </div>    
                        <?php } unset($_SESSION['response']);?>
                    <div class="container">
                        <div class="row">
                             <!-- users visite and profile start -->
                        <div class="col-md-4">
                            <div class="card user-card">
                                <div class="card-header">
                                    <h5>Profile</h5>
                                </div>
                                <div class="card-block">
                                    <div class="usre-image">
                                        <img src="<?= $uphoto;?>" class="img-radius" alt="User-Profile-Image">
                                    </div>
                                    <h6 class="f-w-600 m-t-25 m-b-10"><?= $fullName;?></h6>
                                    <p class="text-muted">Role | <?= $urole;?></p>
                                    <hr/>
                                
                                    <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <hr/>
                                    <div class="row justify-content-center user-social-link">
                                        <div class="col-auto"><a href="#!"><i class="fa fa-facebook text-facebook"></i></a></div>
                                        <div class="col-auto"><a href="#!"><i class="fa fa-twitter text-twitter"></i></a></div>
                                        <div class="col-auto"><a href="#!"><i class="fa fa-dribbble text-dribbble"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     <div class="col-md-8">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#overview"
                                            data-toggle="tab">OverView</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#edit_pro" data-toggle="tab">Edit
                                            Profile</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#change_pass" data-toggle="tab">Change
                                            Password</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- Tab Over view -->
                                <?php require 'includes/users/user-view.php';?>
                                <!-- ./Overview -->
                                    <!--  .Profile edit-->
                                <?php require 'includes/users/user-edit.php';?>
                                    <!-- /.tab-pane -->
                                <?php require 'includes/users/password.php';?>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php';?>