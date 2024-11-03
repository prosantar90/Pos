<form action="action.php" method="post" id="supplier_frm">
    <input type="hidden" name="sup_id" value="<?= $supp_id;?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="supplier_name">Supplier Name</label>
                <input type="text" name="supplier_name" id="supplier_name" class="form-control" value="<?= $supp_name ?>"
                    placeholder="Supplier name" required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="phone">Phone</label>
            <input type="number" name="suPphone" class="form-control" required placeholder="Phone" value="<?= $supp_phone;?>">
        </div>
        <div class="col-md-6">
            <label for="supplierAdd">Address</label>
            <input type="text" name="supAddress" class="form-control" required placeholder="Address" value="<?= $supp_address;?>">
        </div>

        <div class="col-md-6">
            <label for="supplierAdd">Bank Account No</label>
            <input type="text" name="supBankAcc" class="form-control" required placeholder="Acccount No" value="<?= $supp_address;?>">
        </div>
         <div class="col-md-6">
            <label for="supplierAdd">Bank Name</label>
            <input type="text" name="supBankName" class="form-control" required placeholder="Bank Name" value="<?= $supp_address;?>">
        </div>
        <div class="col-md-6">
            <label for="supplierAdd">Bank IFSC</label>
            <input type="text" name="supBankifsc" class="form-control" required placeholder="IFSC" value="<?= $supp_address;?>">
        </div>

        <div class="col-md-3">
            <label for="supplierAdd">Total Amount</label>
            <input type="text" name="supAmount" class="form-control" placeholder="Total Amount" value="<?= $supp_total_amount;?>">
        </div>
         <div class="col-md-3">
            <label for="supplierAdd">Advance Amount</label>
            <input type="text" name="supAdAmount" class="form-control" placeholder="Advance Amount" value="<?= $supp_ad_amount?>">
        </div>

    
        <div class="col-md-12 ">
            <div class="form-group text-center">
                <?php 
                if ($sup === true) {?>
                 <input type="submit" name="up_supplier" class="btn btn-primary mr-0 mt-4" value="Update Supplier"
                    id="up_supplier">   
                <?php }else{
                ?>
                <input type="submit" name="add_supplier" class="btn btn-primary mr-0 mt-4" value="Add Supplier"
                    id="add_supplier">
                    <?php }?>
            </div>
        </div>
    </div>
</form>