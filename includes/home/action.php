<?php 
/**
 * This is for Pay now customer
 */

if (isset($_POST['pay_now'])) {
    $id = checkInput($_POST['pay_now']);
    $checkCust= $customer->getCustomerById($id);
    echo'
    <form action="action.php" method="post">
        <input type="hidden" name="custID" value="'.$id.'">
        <div class="form-group">
            <label>Due Payment</label>
            <input type="text" name="customer_due" id="duePayemnt" class="form-control" value="'. $checkCust['order_total_amount_due'].'">    
            
        </div>
        <div class="form-group">
            <label>Payment Option</label>
            <select class="form-control" name="payment_mod" id="payment_option" required="required">
                <option value="">Select payment options</option>
                <option value="hand_cash">Hand Cash</option>
                <option value="bycheque">By Cheque</option>
                <option value="byaccounts">By accounts</option>
            </select>
            <input id="showInputCheque" type="text" class="form-control mt-3" name="chequeNo" placeholder="xxxxx" style="display:none;">
        </div>
        <input type="submit" class="btn btn-primary" name="customer_pay" value="Pay now">
    </form>             

    ';
    exit();
}