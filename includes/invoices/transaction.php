<?php 
require '../../action.php'; 
require '../../session.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/print-css.css">
</head>
<body>
    <div class="container-fluid bill-container">
     <?php 
    if (isset($_GET['customer_transaction'], $_GET['salt'], $_GET['hash'])) {
    $transactionId = htmlspecialchars(trim($_GET['customer_transaction']));
    $salt = htmlspecialchars(trim($_GET['salt']));
    $hash = htmlspecialchars(trim($_GET['hash']));
    $salted_id = $transactionId . $salt;
    $calculated_hash = hash('sha256', $salted_id);
    $cusDetails = $customer->getCustomerById( $transactionId);
    echo ' <section class="header">
                    <h2>' .$comName.'</h2>
                    <p>'.$uAddress .' </p>
                    <p><b>Ph:</b> '.$uPhone.'</p>
                </section>';

    echo '<div class="customer__details" ><p><b>Customer Name: </b>'.htmlspecialchars($cusDetails['customer_name']) .'</p>';
    echo '<p><b>Father Name:</b> '.htmlspecialchars($cusDetails['father_name']).'</p>';
    echo '<p><b>Phone Number:</b> '.htmlspecialchars($cusDetails['phone_number']). '</p>';
    echo '<p><b>Customer Address:</b>'.htmlspecialchars($cusDetails['customer_address']) .'</p>';
    echo '</div>';
    if ($calculated_hash === $hash) {
        $run = $customer->customerTransaction($transactionId);
        if ($run) {
          echo '

          <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>';

foreach ($run as $transaction) {
    echo "<tr>
            <td>" . htmlspecialchars($transaction['transaction_id']) . "</td>
            <td>" . htmlspecialchars($transaction['transaction_type']) . "</td>
            <td>" . number_format($transaction['amount'], 2) . "</td>
            <td>" . htmlspecialchars($transaction['payment_mode']) . "</td>
            <td>" . htmlspecialchars(inDateTime($transaction['payment_date'])) . "</td>
          </tr>";
}

echo "</tbody>
      <tfoot class='table-dark'>
          <tr>
              <td class='text-right' colspan='3'>Total Amount</td>
              <td colspan='2'>" . htmlspecialchars(number_format($cusDetails['order_amount'], 2)) . "</td>
          </tr>
          <tr>
              <td class='text-right' colspan='3'>Total Paid</td>
              <td colspan='2'>" . htmlspecialchars(number_format($cusDetails['order_amount_paid'], 2)) . "</td>
          </tr>";
          if ($cusDetails['order_total_amount_due'] > 0) {
           echo "<tr>
              <td class='text-right' colspan='3'>Total Due</td>
              <td colspan='2'>" . htmlspecialchars(number_format($cusDetails['order_total_amount_due'], 2)) . "</td>
          </tr>";
          }else{
            echo "
            <tr>
                <td class='text-center' colspan='5'><h2>Paid</h2></td>
            </tr>
            ";
          }
          echo "
      </tfoot>
      </table>";

        } else {
            echo "No transactions found for this ID.";
        }
    } else {
        echo "Invalid transaction. Hash verification failed.";
    }
}
    

if (isset($_GET['supplier_transaction'], $_GET['salt'], $_GET['hash'])) {
    // $id = checkInput($_GET['supplier_transaction']);
     $id = htmlspecialchars(trim($_GET['supplier_transaction']));
    $salt = htmlspecialchars(trim($_GET['salt']));
    $hash = htmlspecialchars(trim($_GET['hash']));
    $salted_id = $id . $salt;
    $calculated_hash = hash('sha256', $salted_id);
    $suppDetails = $supplier->getSupplierById($id);

  if ($calculated_hash === $hash) {
     echo ' <section class="header">
                    <h2>' .$comName.'</h2>
                    <p>'.$uAddress .' </p>
                    <p><b>Ph:</b> '.$uPhone.'</p>
                </section>';

        $run = $supplier->supplierTransaction($id);
        if ($run) {
          echo '
        <!-- Customer Information Section -->
        <section class="customer-info">
            <p><strong>Supplier Name::</strong>'.htmlspecialchars($suppDetails['supplier_name']).'</p>
            <p><strong>Phone Number:</strong> +91'.htmlspecialchars($suppDetails['sup_phone']). '</p>
            <p><strong>Supplier Address:</strong>'.htmlspecialchars($suppDetails['sup_address']). '</p>
        </section>

          <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($run as $transaction) {
            echo "<tr>
                    <td>" . htmlspecialchars($transaction['transaction_id']) . "</td>
                    <td>" . htmlspecialchars($transaction['transaction_type']) . "</td>
                    <td>" . number_format($transaction['amount'], 2) . "</td>
                    <td>" . htmlspecialchars($transaction['payment_mode']) . "</td>
                    <td>" . htmlspecialchars(inDateTime($transaction['payment_date'])) . "</td>
                </tr>";
        }

        echo "</tbody>
            <tfoot class='table-dark'>
                <tr>
                    <td class='text-right' colspan='3'>Total Amount</td>
                    <td colspan='2'>" . htmlspecialchars(number_format($suppDetails['sup_total_amount'], 2)) . "</td>
                </tr>
                <tr>
                    <td class='text-right' colspan='3'>Total Paid</td>
                    <td colspan='2'>" . htmlspecialchars(number_format($suppDetails['sup_ad_amount'], 2)) . "</td>
                </tr>";
                if ($suppDetails['sup_due_amount'] > 0) {
                echo "<tr>
                    <td class='text-right' colspan='3'>Total Due</td>
                    <td colspan='2'>" . htmlspecialchars(number_format($suppDetails[' sup_due_amount '], 2)) . "</td>
                </tr>";
                }else{
                    echo "
                    <tr>
                        <td class='text-center' colspan='5'><h2>Paid</h2></td>
                    </tr>
                    ";
                }
                echo "
            </tfoot>
            </table>";

                } else {
                    echo "No transactions found for this ID.";
                }
            } else {
                echo "Invalid transaction. Hash verification failed.";
            }
}



if (isset($_GET['salesman_transaction'], $_GET['salt'], $_GET['hash'])) {
    // $id = checkInput($_GET['salesman_transaction']);
     $id = htmlspecialchars(trim($_GET['salesman_transaction']));
    $salt = htmlspecialchars(trim($_GET['salt']));
    $hash = htmlspecialchars(trim($_GET['hash']));
    $salted_id = $id . $salt;
    $calculated_hash = hash('sha256', $salted_id);
    $salesmanDe = $salesman->getSalesManById($id);
  if ($calculated_hash === $hash) {
         echo ' <section class="header">
                    <h2>' .$comName.'</h2>
                    <p>'.$uAddress .' </p>
                    <p><b>Ph:</b> '.$uPhone.'</p>
                </section>';

        $run = $salesman->salesManTransaction($id);
        if ($run) {
          echo '
        <!-- Customer Information Section -->
        <section class="customer-info">
            <p><strong>Sales Man Name:</strong>'.htmlspecialchars($salesmanDe['salesman_name']).'</p>
            <p><strong>Phone Number:</strong> +91 '.htmlspecialchars($salesmanDe['salesman_phone']).'</p>
            <p><strong>Sales Man Address:</strong> '.htmlspecialchars($salesmanDe['salesman_address']).'</p>
        </section>

          <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($run as $transaction) {
            echo "<tr>
                    <td>" . htmlspecialchars($transaction['transaction_id']) . "</td>
                    <td>" . htmlspecialchars($transaction['transaction_type']) . "</td>
                    <td>" . number_format($transaction['amount'], 2) . "</td>
                    <td>" . htmlspecialchars($transaction['payment_mode']) . "</td>
                    <td>" . htmlspecialchars(inDateTime($transaction['payment_date'])) . "</td>
                </tr>";
        }

        $dueBalance = $salesmanDe['balance'] - $salesmanDe['paid_amount'];
        echo "</tbody>
            <tfoot class='table-dark'>
                <tr>
                    <td class='text-right' colspan='3'>Total Amount</td>
                    <td colspan='2'>" . htmlspecialchars(number_format($salesmanDe['balance'], 2)) . "</td>
                </tr>
                <tr>
                    <td class='text-right' colspan='3'>Total Paid</td>
                    <td colspan='2'>" . htmlspecialchars(number_format($salesmanDe['paid_amount'], 2)) . "</td>
                </tr>";
                if ($dueBalance >0) {
                echo "<tr>
                    <td class='text-right' colspan='3'>Total Due</td>
                    <td colspan='2'>" . htmlspecialchars(number_format($dueBalance, 2)) . "</td>
                </tr>";
                }else{
                    echo "
                    <tr>
                        <td class='text-center' colspan='5'><h2>Paid</h2></td>
                    </tr>
                    ";
                }
                echo "
            </tfoot>
            </table>";

                } else {
                    echo "No transactions found for this ID.";
                }
            } else {
                echo "Invalid transaction. Hash verification failed.";
            }
}

    ?>

    </div>
   
</body>
</html>