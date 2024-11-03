 <form action="action.php" method="post">
     <input type="hidden" name="exis_cust" id="exists_customer"
         value="<?= isset($_SESSION['form_data']['exis_cust']) ? $_SESSION['form_data']['exis_cust'] : ''; ?>">
     <!-- Card Start -->
     <div class="card" id="sales_frm">
         <div class="card-header p-2">
             <h5 class="mb-3">Sales Form:</h5>
             <div class="float-right">
                 <?php 
                    if (get_sales_no() !==0) {?>
                 <h5 class="mb-0">Invoice #<?= get_sales_no()?></h5>
                 <input type="hidden" name="invoice_no" value="<?= get_sales_no()?>">
                 <?php } else {?>
                 <h5 class="mb-0">Invoice #</h5>
                 <input type="hidden" name="invoice_no" value="1">
                 <?php } ?>
                 Date: <?php echo date('d-M-Y');?>
             </div>
         </div>
         <div class="row">
             <div class="col-sm-3 ">
                 <input id="customer_name" type="text" class="form-control" name="customer_name"
                     value="<?= isset($_SESSION['form_data']['customer_name']) ? $_SESSION['form_data']['customer_name'] : ''; ?>"
                     placeholder="Customer Name" autocomplete="off">
                 <ul id="customerList" class="list-group" style="position: absolute; z-index: 1000; display: none;">
                 </ul>
             </div>
             <div class="col-sm-3 ">
                 <input type="text" id="cus_father" class="form-control" name="cum_father"
                     value="<?= isset($_SESSION['form_data']['cum_father']) ? $_SESSION['form_data']['cum_father'] : ''; ?>"
                     placeholder="Father Name">
             </div>
             <div class="col-sm-3 ">
                 <input id="cus_phone" type="text" class="form-control" name="cum_phone"
                     value="<?= isset($_SESSION['form_data']['cum_phone']) ? $_SESSION['form_data']['cum_phone'] : ''; ?>"
                     placeholder="Phone Number">
             </div>
             <div class="col-sm-3 ">
                 <textarea id="cus_address" name="address" id="address" class="form-control"
                     placeholder="Address"><?= isset($_SESSION['form_data']['address']) ? $_SESSION['form_data']['address'] : ''; ?></textarea>
             </div>
             <div class="col-md-3"> <?php 
                     $salsman = new Salesman($conn);
                     $salemans= $salsman->getAllSaleMans();
                     ?>

                 <select name="salesman" id="salasman" class="form-control select1">
                     <option value="">Select Sales Man</option>
                    <?php foreach ($salemans as $man) {
                        echo '<option value="'.$man['ID'].'">'.$man['salesman_name'].'</option>';
                    }?>
                 </select>
             </div>
             <div class="col-md-3">
                 <input type="text" name="salesman_amount" class="form-control" placeholder="Enter Sales Man Amount">
             </div>
         </div>

     </div>
     <div class="col-md-12">
         <!-- Row start for input form  -->
         <div class="row">
             <div class="col-md-2">
                 <div class="form-group">
                     <label for="product_name">Product Code</label>
                     <input type="text" name="pro_code" id="pro_code" class="form-control" placeholder="Product code">
                     <input type="hidden" name="pro_id" id="pro_id">
                     <p id="code_error" style="display:none;" class="text-danger text-center"></p>
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="form-group">
                     <label for="product_name">Product Name</label>
                     <input type="text" name="pro_name" id="pro_name" class="form-control" disabled>
                 </div>
             </div>

             <div class="col-md-2">
                 <div class="form-group">
                     <label for="product_price">Product Price</label>
                     <select name="pro_prce" id="pro_prce" class="select1 form-control">
                        <option value="">Select Option</option>
                     </select>
                     <!-- <input type="text" name="pro_prce" id="pro_prce" class="form-control" disabled> -->
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="form-group">
                     <label for="product_price">Product QTY</label>
                     <input type="number" name="pro_qty" id="pro_qty" class="form-control">
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="form-group">
                     <label for="product_price">Product Total</label>
                     <input type="text" name="pro_total" id="pro_total" class="form-control" disabled>
                 </div>
             </div>
             <div class="col-md-1">
                 <button id="add_row" class="btn btn-primary mt-4">Add</button>
             </div>
             <!-- Row end -->
         </div>
     </div>
     <div class="table-responsive-sm">
         <table class="table table-striped p-0" id="sales_invoice">
             <thead>
                 <tr>
                     <th class="center">#</th>
                     <th>Item</th>
                     <th class="right">Price</th>
                     <th class="center">Qty</th>
                     <th class="right">Total</th>
                 </tr>
             </thead>
             <tbody id="append">

             </tbody>
         </table>

     </div>
     <div class="row">
         <div class="col-lg-4 col-sm-5">
         </div>
         <div class="col-lg-4 col-sm-5 ml-auto">
             <table id="salesFooter" class="table table-clear">
                 <tbody>
                     <tr>
                         <td class="left">
                             <strong class="text-dark">Subtotal</strong>
                         </td>
                         <td class="right">
                             <span class="sub-total"></span>
                             <input type="hidden" name="sub_total" class="sub-total-hidden">
                         </td>
                     </tr>
                     <tr>
                         <td class="left">
                             <strong class="text-dark">Paid Amount</strong>
                         </td>
                         <td class="right">
                             <input id='paid-amount' type="text" name="paid-amount" class="form-control paid-amount">
                         </td>
                     </tr>
                     <tr>
                         <td class="left">
                             <strong class="text-dark">Due Amount</strong>
                         </td>
                         <td class="right">
                             <strong id='due_amount' class="text-dark"></strong>
                             <input type="hidden" name="due_amount" id="due_amount_input">
                         </td>
                     </tr>
                     <tr id="promise_date" style="display:none;">
                         <td class="left">
                             <strong class="text-dark">Promise Date</strong>
                         </td>
                         <td  class="right">
                             <strong id='due_amount' class="text-dark"></strong>
                             <input type="text" name="cus_promise_date" id="cus_promise_date" class="form-control" placeholder="dd-mm-yy">
                         </td>
                     </tr>
                     <tr>
                         <td class="left">
                             <strong class="text-dark">Payment Options</strong>
                         </td>
                         <td class="right">
                                <select class="form-control" name="SalesPayment_mod" id="payment_option" required='required'>
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
     </div>
     </div>
     <!-- Submit Button -->
     <button class="btn btn-success" name="sales_btn">Submit</button>
     <!-- End Card -->
 </form>