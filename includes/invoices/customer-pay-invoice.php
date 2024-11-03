<?php 
require '../../action.php'; 
require '../../session.php';

if (isset($_GET['customer_pay_invoice'])) {
    $invoice_no = $_GET['customer_pay_invoice'];

    $transaction = $transaction->getTransactionById($invoice_no);
    
    if ($transaction) {
        $customer = $customer->getCustomerById($transaction['entity_id']);
        $customer['customer_name'];
        $date = date('Y-m-d', strtotime($transaction['payment_date']));
        $amount = $transaction['amount'];
        $payment_mode = $transaction['payment_mode'];
        $chequeNo = !empty($transaction['chequeOraccNo']) ? $transaction['chequeOraccNo'] : 'N/A';
    } else {
        echo "Invalid Invoice Number!";
        exit;
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Slip - Invoice #<?php echo htmlspecialchars($invoice_no); ?></title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/print-css.css">
</head>
<body>
    <div class="container-fluid bill-container">
        <section class="header">
            <h2><?php echo $comName; ?></h2> <!-- Company Name -->
            <p><?php echo $uAddress; ?></p> <!-- Company Address -->
            <p><b>Ph:</b> <?php echo $uPhone; ?></p> <!-- Company Phone -->
        </section>

        <div class="slip-content">
            <h4>Payment Slip</h4>
            <table class="table p-0 m-0">
                <tbody>
                    <tr>
                        <th>Customer ID</th>
                        <td><?php echo htmlspecialchars($transaction['entity_id']); ?></td>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td><?php echo htmlspecialchars($customer['customer_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Payment Date</th>
                        <td><?php echo $date; ?></td>
                    </tr>
                    <tr>
                        <th>Amount Paid</th>
                        <td><?php echo number_format($amount, 2); ?></td>
                    </tr>
                    <tr>
                        <th>Payment Mode</th>
                        <td><?php echo htmlspecialchars($payment_mode); ?></td>
                    </tr>
                    <tr>
                        <th>Cheque/Account No</th>
                        <td><?php echo htmlspecialchars($chequeNo); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="slip-footer">
            <p>Thank you for your payment!</p>
        </div>
    </div>
</body>
</html>
