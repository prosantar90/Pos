 <form action="action.php" method="post" id="purchase_frm">
    <input type="hidden" name="purchase_id" value="<?= $purchase_id;?>">
     <div class="row">
    <div class="col-md-12">
             <div class="form-group">
                 <label for="supplier_name">Supplier Name</label>
                 <select name="supplier_name" id="supplier_name" class="form-control">
                     <?php 
                        $su =new supplier($conn);
                        $supps = $su->getAllActiveSuppliers();
                    foreach ($supps as $sup) { ?>
                        <option value="<?= $sup['sup_ID'] ?>" <?= ($sup['sup_ID'] == $purSupplier_id) ? 'selected' : '' ?>>
                            <?= $sup['supplier_name']; ?>
                        </option>
                    <?php } ?>
                 </select>
             </div>
         </div>
         <div class="col-md-2">
             <div class="form-group">
                 <label for="product_code">Product Code</label>
                 <input type="text" name="product_code" id="product_code" class="form-control" value="<?= $pur_product_code?>"
                     placeholder="Enter product code">
             </div>
         </div>
         <div class="col-md-2">
             <div class="form-group">
                 <label for="product_name">Product Name</label>
                 <input type="text" id="product_name" class="form-control" value="<?= $pur_product_name;?>"
                     placeholder="Product Name" readonly>
               <input type="hidden" id="product_id">
             </div>
         </div>
         <div class="col-md-1">
             <div class="form-group">
                 <label for="product_unit">Unit</label>
                 <input type="text" name="product_unit" id="product_unit" class="form-control" value="<?= $pur_product_unit;?>"
                     placeholder="Unit" readonly>
             </div>
         </div>
           <div class="col-md-1">
             <div class="form-group">
                 <label for="product_name">MRP</label>
                 <input type="text" name="product_price" id="PrMrp" class="form-control" value="<?= $pur_product_price;?>"
                     placeholder="MRP" readonly>
             </div>
         </div>
         <div class="col-md-1">
             <div class="form-group">
                 <label for="product_qty">AVl Qty</label>
                 <input type="text" id="AvlQty" class="form-control" 
                     placeholder="qty" readonly>
             </div>
         </div>
        <div class="col-md-2">
             <div class="form-group">
                 <label for="product_qty">Current Qty</label>
                 <input type="text" name="product_cur_qty" id="CurrentQty" class="form-control" value="<?= $pur_product_qty;?>"
                     placeholder="Current qty">
             </div>
         </div>

          <div class="col-md-2">
             <div class="form-group">
                 <label for="product_qty">Purchase Price</label>
                 <input type="text" id="PurchasePrice" class="form-control"
                     placeholder="Purchase Price">
             </div>
         </div>
          <div class="col-md-2">
             <div class="form-group">
                 <label for="product_qty">Whole Sale Price</label>
                 <input type="text" id="WholeSalePrice" class="form-control" value="<?= $pur_product_qty;?>"
                     placeholder="WSP">
             </div>
         </div>
         <div class="col-md-2">
             <div class="form-group">
                 <label for="product_qty">Sale Price</label>
                 <input type="text" id="SalePrice" class="form-control" value="<?= $pur_product_qty;?>"
                     placeholder="SP">
             </div>
         </div>
         
        <div class="col-md-2">
            <button id="add_purchase_row" class="btn btn-primary mt-4">Add</button>
        </div>

        <div class="col-md-12">
          <table class="table table-striped" id="">
            <thead>
                <th>Sl</th>
                <th>Product Name</th>
                <th>Purchas Pice</th>
                <th>Sales Pice</th>
                <th>Whole Sale Price</th>
                <th>Current Qty</th>
            </thead>
            <tbody id="purchaseProducts">

            </tbody>
            </table>

        </div>
        <div class="col-lg-4 col-sm-5 ml-auto">
             <table class="table table-clear">
                 <tbody>
                     <tr>
                         <td class="left">
                             <strong class="text-dark">Purchase Total</strong>
                         </td>
                         <td class="right">
                             <span class="sub-total"></span>
                             <input type="hidden" name="purchaseTotal" class="sub-total-hidden">
                         </td>
                     </tr>
                     <!-- <tr>
                         <td class="left">
                             <strong class="text-dark">Paid Amount</strong>
                         </td>
                         <td class="right">
                             <input id='paid-amount' type="text" name="paid-amount" class="form-control paid-amount">
                         </td>
                     </tr> -->
                       <tr>
                         <td class="left">
                             <strong class="text-dark">Payment Options</strong>
                         </td>
                         <td class="right">
                                <select class="form-control" name="PurchasePayment_mod" id="payment_option">
                                    <option value="">Select payment options</option>
                                    <option value="hand_cash">Hand Cash</option>
                                    <option value="bycheque">By Cheque</option>
                                    <option value="byaccounts">By accounts</option>
                                </select>
                            </div>

                         </td>
                     </tr>
                     <tr id="showInputCheque" style="display:none;">
                        <td colspan="2"> <input type="text" name="chequeOrAccount" class="form-control" placeholder="XXXXXXX"></td>
                     </tr>
                 </tbody>
             </table>
         </div>
 


         <div class="col-md-12">
            <?php if($purchase_view === true){?>
             <input type="submit" value="Update Purchase" name="update_purchase" class="btn btn-block btn-primary" id="update_purchase">
             <?php }else{?>
             <input type="submit" value="Purchase" name="purchase" class="btn btn-block btn-primary" id="purchase">
             <?php }?>
         </div>
     </div>
 </form>