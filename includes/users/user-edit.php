<div class="tab-pane" id="edit_pro">
    <form method="POST" enctype="multipart/form-data" id="ufrm" action="action.php">
        <input type="hidden" name="uid" value="<?= $user_name;?>">
        <div class="row mb-3">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                Image</label>
            <div class="col-md-8 col-lg-9">
                <img src="<?= $uphoto?>" width="100" alt="Profile">
                <div class="pt-2">
                    <!-- <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i
                            class="fas fa-upload"></i></i></a> -->
                    <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                            class="far fa-trash-alt"></i></a> -->
                <input type="hidden" name="oldimage" id="oldimage" value="<?= $uphoto;?>">
                <input type="file" name="u_photo" id="image">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                Name</label>
            <div class="col-md-8 col-lg-9">
                <input name="fullName" type="text" class="form-control" id="fullName" value="<?= $fullName?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="uabout" class="form-control" id="about" style="height: 138px;"><?=$uabout;?></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
            <div class="col-md-8 col-lg-9">
                <input name="ucompany" type="text" class="form-control" id="company" value="<?= $comName?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="company" class="col-md-4 col-lg-3 col-form-label">Company Regd No</label>
            <div class="col-md-8 col-lg-9">
                <input name="cregd_no" type="text" class="form-control" id="cregd_no" value="<?= $comRegd_no?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
            <div class="col-md-8 col-lg-9">
                <input name="ucountry" type="text" class="form-control" id="Country" value="<?= $ucountry;?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
            <div class="col-md-8 col-lg-9">
                <input name="uaddress" type="text" class="form-control" id="Address" value="<?= $uAddress;?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
            <div class="col-md-8 col-lg-9">
                <input name="uphone" type="text" class="form-control" id="Phone" value="<?= $uPhone;?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input name="uemail" type="email" class="form-control" id="Email" value="<?= $uemail?>">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" id="uUpdate" name="uUpdate" class="btn btn-primary">Save Changes</button>
        </div>
    </form>

</div>