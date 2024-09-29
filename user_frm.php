<?php 
require_once 'includes/header.php'; 
require_once 'includes/sidebar.php';
$userOptions = [
    '' => 'Please select user role',
    'admin' => 'Admin',
    'staf' => 'Staf'
];



?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <?php alertMsg(); ?>
                <div class="card"> <!-- Card Start -->
                    <div class="card-block">
                        <form action="action.php" method="post" id="ufrm" enctype="multipart/form-data"> <!-- From start -->
                            <div class="container">
                                <div class="row">   
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="Username">Full name</label>
                                            <input class="form-control" type="text" value="<?= $userFullName;?>" name="ufname" id="ufname" placeholder="Full Name"  required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="Username">User name</label>
                                            <input class="form-control" type="text" value="<?= $username?>" name="uname" id="uname" placeholder="Username" required>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="email" value="<?= $userEmail;?>" name="uemail" id="uemail" placeholder="Email" required>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="upass">Password</label>
                                            <input class="form-control" type="password" name="upass" id="upass" value="" placeholder="Password" required>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="ucpass">Confrim Password</label>
                                            <input class="form-control" type="password" name="ucpass" id="ucpass" placeholder="Confrim Password" required>
                                        </div>
                                    </div>

                                    
                                      <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="utype">User Type</label>
                                            <select class="form-control" name="utype" id="utype" required>
                                                <?php 
                                                foreach ($userOptions as $value => $label) {
                                                        $selected = ($value == $userRole) ? 'selected="selected"' : '';
                                                        echo "<option value=\"$value\" $selected>$label</option>";
                                                    }
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="custom-file">
                                              <label for="uphoto" class="custom-file-label">Upload profile photo</label>
                                            <input class="form-control custom-file" type="file" name="uphoto" id="uphoto">
                                            <img src="<?= $userPhoto?>" class="img img-thumbnail" width="100" alt="<?= $userPhoto;?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-5">
                                        <div class="from-group">
                                            <?php if($users == true){?>
                                           <input type="submit" id="update_user" name="update_user" class="btn btn-block btn-primary mt-3" value="Update  User">
                                           <?php }else{?>
                                           <input type="submit" id="add_user" name="add_user" class="btn btn-block btn-primary mt-3" value="Add User">
                                           <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p id="user_error" class="text-danger text-center mt-3"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </form> <!-- End form -->
                </div>
            </div> <!-- card end -->
        </div>
    </div>
</div>
<!-- End Main content -->
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<?php include 'includes/footer.php';?>