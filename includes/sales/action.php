<?php 
$customer = new customers($conn);
$sales = new Sales($conn);
$product = new Product($conn);
$transaction = new Transaction($conn);

if (isset($_POST['sub_sale'])) {
    $pr_id = $_POST['pro_id'];
    $customer_id = 2;
    $sal_qty = $_POST['sal_qty'];
    $sal_price = $_POST['sal_price'];
    $sal_total = $_POST['sal_total'];
    
    foreach ($pr_id as $key => $product_id) {
        $pro_id = $product_id;
        $sales_qty = $sal_qty[$key];
        $sales_price = $sal_price[$key];
        $sales_total = $sal_total[$key];
        $sq ="INSERT INTO sales(customer_id, product_id, sales_qty, sales_price, sales_total_amount) VALUES (?,?,?,?,?)";
        $ss= $conn->prepare($sq);
        $ss->bind_param('issss', $customer_id, $pro_id, $sales_qty, $sales_price, $sales_total);
        $ss->execute();
    }
}
/**
 * Get Product details using ajax
 * This Is for input field from form.
 * @package 
 * Best Pos Sofware
 */
if (isset($_GET['pro_code'])) {
    $code = checkInput($_GET['pro_code']);
    $row=getProductByCode($code);
    echo json_encode($row);
}

/**
 * Add sales using cool Logic From Add new Sale btn
 * @package 
 * Best Pos Software
 * 
 */

if (isset($_POST['sales_btn'])) {
    date_default_timezone_set('Asia/Kolkata');
    $exists_customer = checkInput($_POST['exis_cust']);
    $salesman_exist = checkInput($_POST['salesman']);
    $salesManAmount = checkInput($_POST['salesman_amount']);
    $invoice_no = checkInput($_POST['invoice_no']);
    $customer_name = checkInput($_POST['customer_name']);
    $customer_fatherName = checkInput($_POST['cum_father']);
    $customer_phone = checkInput($_POST['cum_phone']);
    $cum_addr = checkInput($_POST['address']);
    $order_amount = checkInput($_POST['sub_total']);
    $order_amount_paid = checkInput($_POST['paid-amount']);
    $order_due_amount = checkInput($_POST['due_amount']);
    $promise_date = checkInput($_POST['cus_promise_date']);
    $paymentOption = checkInput($_POST['SalesPayment_mod']);
    $chequeAcoounrNo = checkInput($_POST['chequeOrAccount']);

    $_SESSION['form_data'] = $_POST;

    // Validate customer details
    if (empty($customer_name) || empty($customer_fatherName) || empty($cum_addr)) {
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Please enter Customer details fields';
        header('location: sales-frm.php');
        exit();
    }

    // Step 1: Update Salesman balance if selected
    if ($salesman_exist) {
        $id = $salesman_exist;
        $getAmountById = $salesman->getSalesManById($id);
        $oldAmount = $getAmountById['balance'];
        $totalAmount = $oldAmount + $salesManAmount;
        $data = ['balance' => $totalAmount];
        $run = $salesman->updateSalesMan($data, $id);

        // If salesman update failed, return an error
        if (!$run) {
            $_SESSION['res_type'] = 'danger';
            $_SESSION['response'] = 'Failed to update Salesman balance: ' . mysqli_error($conn);
            header('location: sales-frm.php');
            exit();
        }
    }

    // Step 2: Process Existing Customer or New Customer
    if (!empty($exists_customer)) { 
        // Existing Customer
        $getcustomer_detail = $customer->getCustomerById($exists_customer);
        $total_order_amount = $getcustomer_detail['order_amount'] + $order_amount;
        $new_paid_amount = $getcustomer_detail['order_amount_paid'] + $order_amount_paid;
        $new_order_due = $order_due_amount > 0 ? $getcustomer_detail['order_total_amount_due'] + $order_due_amount : $getcustomer_detail['order_total_amount_due'];

        $customer_update = [
            'order_amount' => $total_order_amount,
            'order_amount_paid' => $new_paid_amount,
            'order_total_amount_due' => $new_order_due,
            'cus_updated' => date('Y-m-d H:i:s'),
            'promis_date' => !empty($order_due_amount) ? $promise_date : null,
        ];

        $run = $customer->updateCustomer($customer_update, $exists_customer);

        if (!$run) {
            $_SESSION['res_type'] = 'danger';
            $_SESSION['response'] = 'Failed to update customer: ' . mysqli_error($conn);
            header('location: sales-frm.php');
            exit();
        }

        // Process products for the existing customer
        $product_ids = $_POST['product_ids'];
        $product_names = $_POST['product_name'];
        $product_qty = $_POST['product_qty'];
        $product_price = $_POST['product_price'];
        $product_total = $_POST['product_total'];

        foreach ($product_names as $key => $pname) {
            $pname = $pname;
            $product_id = $product_ids[$key];
            $pqty = $product_qty[$key];
            $pprice = $product_price[$key];
            $ptotal = $product_total[$key];
            $current_product = $product->getProductById($product_id);

            $saleData = [
                'customer_id' => $exists_customer,
                'sales_invoice' => $invoice_no,
                'product_id' => $product_id,
                'sales_qty' => $pqty,
                'sales_price' => $pprice,
                'sales_total_amount' => $ptotal,
            ];

            $runSale = $sales->addSales($saleData);

            if (!$runSale) {
                $_SESSION['res_type'] = 'danger';
                $_SESSION['response'] = 'Failed to add sale: ' . mysqli_error($conn);
                header('location: sales-frm.php');
                exit();
            }

            $current_qty = $current_product['quantity'];
            $new_qty = $current_qty - $pqty;

            if ($new_qty >= 0) {
                $product_update = ['quantity' => $new_qty];
                $product->updateProduct($product_update, $product_id);
            } else {
                $_SESSION['res_type'] = 'danger';
                $_SESSION['response'] = "Insufficient stock for product ID: $product_id";
                header('location: sales-frm.php');
                exit();
            }
        }
            $transactionData = [
                'transaction_type'=> 'sales_payment',
                'entity_id'      => $exists_customer,
                'amount'         => $order_amount_paid,
                'payment_mode'   => $paymentOption,
                'chequeOraccNo'  =>!empty($chequeAcoounrNo) ? $chequeAcoounrNo : NULL,
                'payment_date' => date('Y-m-d H:i:s'),
            ];
            
           $allSucess = $transaction->addTransaction($transactionData);
            if ($allSucess) {
                $_SESSION['res_type'] = 'success';
                $_SESSION['response'] = 'Sales generated successfully';
                
                echo "<script>
                    var dataWindow = window.open('includes/invoices/sales-print.php?invoice=$invoice_no', '_blank');
                    dataWindow.focus();
                    window.location.href = 'sales-frm.php';
                </script>";

                unset($_SESSION['form_data']);
                exit(); // Stop the script after outputting the JS
            }

    } else {
        // New Customer
        $newCustomer = [
            'customer_name' => $customer_name,
            'father_name' => $customer_fatherName,
            'phone_number' => $customer_phone,
            'customer_address' => $cum_addr,
            'order_amount' => $order_amount,
            'order_amount_paid' => $order_amount_paid,
            'order_total_amount_due' => $order_due_amount,
            'promis_date' => !empty($order_due_amount) ? $promise_date : null
        ];

        $runNewCustomer = $customer->addCustomer($newCustomer);

        if (!$runNewCustomer) {
            $_SESSION['res_type'] = 'danger';
            $_SESSION['response'] = 'Failed to add new customer: ' . mysqli_error($conn);
            header('location: sales-frm.php');
            exit();
        }

        $newCus_id = $conn->insert_id;

        if ($newCus_id > 0) {
            // Process products for the new customer
            $product_ids = $_POST['product_ids'];
            $product_names = $_POST['product_name'];
            $product_qty = $_POST['product_qty'];
            $product_price = $_POST['product_price'];
            $product_total = $_POST['product_total'];

            foreach ($product_names as $key => $pname) {
                $product_id = $product_ids[$key];
                $pqty = $product_qty[$key];
                $pprice = $product_price[$key];
                $ptotal = $product_total[$key];
                $current_product = $product->getProductById($product_id);

                $saleData = [
                    'customer_id' => $newCus_id,
                    'sales_invoice' => $invoice_no,
                    'product_id' => $product_id,
                    'sales_qty' => $pqty,
                    'sales_price' => $pprice,
                    'sales_total_amount' => $ptotal,
                ];

                $runSale = $sales->addSales($saleData);

                if (!$runSale) {
                    $_SESSION['res_type'] = 'danger';
                    $_SESSION['response'] = 'Failed to add sale: ' . mysqli_error($conn);
                    header('location: sales-frm.php');
                    exit();
                }

                $current_qty = $current_product['quantity'];
                $new_qty = $current_qty - $pqty;

                if ($new_qty >= 0) {
                    $product_update = ['quantity' => $new_qty];
                    $product->updateProduct($product_update, $product_id);
                } else {
                    $_SESSION['res_type'] = 'danger';
                    $_SESSION['response'] = "Insufficient stock for product ID: $product_id";
                    header('location: sales-frm.php');
                    exit();
                }

            }
             $transactionData = [
                'transaction_type'=> 'sales_payment',
                'entity_id'      => $newCus_id,
                'amount'         => $order_amount_paid,
                'payment_mode'   => $paymentOption,
                'chequeOraccNo'  => !empty($chequeAcoounrNo) ? $chequeAcoounrNo : NULL ,
                'payment_date' => date('Y-m-d H:i:s'),
            ];
        
            $allSucess = $transaction->addTransaction($transactionData);
            if ($allSucess) {
                $_SESSION['res_type'] = 'success';
                $_SESSION['response'] = 'Sales generated successfully';
                echo "<script>
                    var dataWindow = window.open('includes/invoices/sales-print.php?invoice=$invoice_no', '_blank');
                    dataWindow.focus();
                    window.location.href = 'sales-frm.php';
                </script>";
                unset($_SESSION['form_data']);
            }
        }
    }
}
/**
 * Get Printing sales Invoice Code 
 * It Will genereant and manually
 * @package 
 * Best Pos Software 
 */
if (isset($_GET['invoice'])) {
    $invoice_no = checkInput($_GET['invoice']);
    $sql = "SELECT sales.sales_invoice,customers.customer_name,customers.phone_number, sales.created_at  FROM sales 
    LEFT JOIN customers ON 
    sales.customer_id =customers.cum_id
     WHERE sales.sales_invoice= ?";
    $row= byId($sql, $invoice_no);
    $invoice_no =  $row['sales_invoice'];
    $customer_name = $row['customer_name'];
    $phone_number = $row['phone_number'];
    $invoice_created = $row['created_at'];
    
}


/**
 * Export sales in Csv  Format for easy to calculate Data 
 * @package
 * Best Pos software
 */
if (isset($_POST['export_csv_sales'])) {
    $filename ='';
    $header = array('Invoice No', 'Customer Id', 'Customer Name', 'Total Quantity', 'Total Amount', 'Date', 'Time');
    $query = "SELECT sales.sales_invoice,sales.customer_id,customers.customer_name, SUM(sales.sales_qty) as qty, SUM(sales.sales_total_amount) as total, created_at FROM sales LEFT JOIN customers ON sales.customer_id= customers.cum_id GROUP BY sales.sales_invoice";
    export_csv($filename, $header, $query, $conn, 'created_at', 'd-m-Y');
}

/**
 * Sales Invoice Delete
 */
if (isset($_POST['invoiceId'])) {
    $id= checkInput($_POST['invoiceId']);
    $run = $sales->deleteSales($id);
    if($run){
        echo 'ok';
    }else{
        echo 'Something Went Wrong';
    }
}
if (isset($_POST['getInvoiceNo'])) {
    $invoiceId = checkInput($_POST['getInvoiceNo']);
    // $run = $sales->getSalesByInvoice($invoiceId);
    $bill = "SELECT * FROM `sales` LEFT JOIN products ON sales.product_id = products.product_id  WHERE sales_invoice=?";
    $runBills = showinvoice($bill, $invoiceId);
    $sl =1;
    $totalSum= 0;
    echo '<table class="table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
                </thead><tbody>';
        foreach ($runBills as $item) {
             $totalSum += $item['sales_total_amount'];  
            echo '
           <tr>
            <td>'.$sl++.'</td>
            <td>'.$item['product_name'].'</td>
            <td>'.$item['sales_qty'].' * '.$item['sales_price'].'</td>
            <td>'. $item['sales_total_amount'].'</td>
           </tr>
            ';
        }
      echo '</tbody>  
       <tfoot>
            <tr>
                <td class="total__text" colspan=3>Total</td>
                <td class="total__amount"><strong>Rs '. $totalSum. '</strong></td>
            </tr>
            <tr>
                <td class="total_text_word" colspan="3">Rupees:'. numberToWords($totalSum).' only</td>
            </tr>
        </tfoot>
    </table>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>';
}


