<div class="tab-pane" id="change_pass">
    <form method="POST" id="chfrm">
    <input type="hidden" name="uid" value="<?= $username;?>">
        <div class="row mb-3">
            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="currentPassword" type="password" class="form-control" id="currentPassword">
            </div>
        </div>

        <div class="row mb-3">
            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="newpass" type="password" class="form-control" id="newpass">
            </div>
        </div>

        <div class="row mb-3">
            <label for="cpass" class="col-md-4 col-lg-3 col-form-label">Re-enter
                New Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="cpass" type="password" class="form-control" id="cpass">
            </div>
        </div>

        <div class="text-center">
            <button type="submit" id="pasupdate" class="btn btn-primary">Change Password</button>
        </div>
    </form>
</div>