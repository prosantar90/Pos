<?php 
require '../../action.php'; 
require '../../session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $comName;?></title>
    <!-- Ensure the page is responsive and print-friendly -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/print-css.css">
</head>
<body>
    <div class="container-fluid bill-container">
        <!-- Shop and Invoice Header -->
        <section class="header">
            <h2><?= $comName; ?></h2>
            <p>Invoice No: <?= $invoice_no;?></p>
            <p>Date: <?= $invoice_created; ?></p>
        </section>

        <!-- Customer Information Section -->
        <section class="customer-info">
            <p><strong>Customer Name:</strong><?= $customer_name;?></p>
            <p><strong>Phone Number:</strong> +91<?= $phone_number;?></p>
        </section>

        <!-- Bill Content (Product List) -->
        <section class="content-section">
            <table>
                <thead>
                    <?php 
                    $totalSum= 0;
                    $bill = "SELECT * FROM `sales` WHERE sales_invoice=?";
                    $runbills = showinvoice($bill, $invoice_no);         
                    ?>    
                
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($runbills as $item) {   
                            $totalSum += $item['sales_total_amount'];  
                    ?>
                    <tr>
                        <td><?= $item['product_id']?></td>
                        <td><?= $item['sales_qty']?></td>
                        <td><?= $item['sales_price']?></td>
                        <td><?= $item['sales_total_amount']?></td>
                    </tr>
                    <?php  }?>
                </tbody>
            </table>
        </section>

        <!-- Footer (Total and Thank You) -->
        <section class="footer">
            <p><strong>Total:Rs <?= $totalSum;?></strong></p>
            <p>Rupees: <?= numberToWords($totalSum);?> only</p>
            <p>Thank you for shopping with us!</p>
        </section>
    </div>
    <script type="text/javascript">
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
</body>
</html>
