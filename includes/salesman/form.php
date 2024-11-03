<form action="action.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="man_id" value="<?=  $manID;?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="salesmanName">Sales Man Name</label>
                <input type="text" class="form-control" value="<?= $manName?>" placeholder="Sales man Name" name="sale_name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="salesmanfName">Father Name</label>
                <input type="text" class="form-control" name="sale_f_name" value="<?= $manFatherName; ?>" placeholder="Father Name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="salesmanfName">Phone</label>
                <input type="text" class="form-control" name="sale_phone" value="<?= $manPhone?>" placeholder="Phone No" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="salesman_address">Address</label>
                <textarea type="text" class="form-control" name="salesman_address" placeholder="Address" required><?= $manAddress?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="salesman_ac">Bank Account No</label>
                <input type="text" class="form-control" name="salesman_ac" value="<?= $manAcc; ?>" placeholder="Account No" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="salesman_ifsc">IFSC</label>
                <input type="text" class="form-control" name="salesman_ifsc" value="<?=  $manIfsc; ?>" placeholder="IFSC" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="salesman_bank_name">Bank Name</label>
                <input type="text" class="form-control" name="salesman_bank_name" value="<?= $manBank; ?>" placeholder="Bank Name" required>
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label for="salesman_bank_name">Image</label>
                <input type="file" class="form-control" name="salesmans_image">
                <img class="img img-circle mt-2" width="100" src="<?= $manImg ?>" alt="<?= $manImg ?>">
            </div>
        </div>
        <div class="col-md-12">
            <?php if ($manUp === true) {?>
            <input type="submit" name="update_salesMan" value="Update Salesman" class="btn btn-block btn-primary">
            <?php }else{?>
            <input type="submit" name="add_salesMan" value="Add Sales Man" class="btn btn-block btn-primary">
            <?php }?>
        </div>
    </div>
</form>