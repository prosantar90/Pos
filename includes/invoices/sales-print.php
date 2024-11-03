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
            <p><?= $uAddress?></p>
            <p><b>Ph:</b> <?= $uPhone;?></p>
        </section>

        <!-- Customer Information Section -->
        <section class="customer-info">
            <div class="head_footer">
                <p><b>Invoice No:</b> <?= $invoice_no;?></p>
                <p>Date: <?= inDateTime($invoice_created); ?></p>
            </div>
            <p><strong>Customer Name:</strong><?= $customer_name;?></p>
            <p><strong>Phone Number:</strong> +91<?= $phone_number;?></p>
        </section>

        <!-- Bill Content (Product List) -->
        <section class="content-section">
            <table>
                <thead>
                    <?php 
                    $totalSum= 0;
                    $bill = "SELECT products.product_id, products.product_name, sales.sales_qty, sales.sales_price, sales.sales_total_amount FROM `sales` 
                    LEFT JOIN products ON sales.product_id = products.product_id
                    WHERE sales_invoice=?";
                    $runbills = showinvoice($bill, $invoice_no); 
                    ?>
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sl =1;
                        foreach ($runbills as $item) {   
                            $totalSum += $item['sales_total_amount'];  
                    ?>
                    <tr>
                        <td><?php echo $sl++; ?></td>
                        <td><?= $item['product_name']?></td>
                        <td><?= $item['sales_qty']?> * <?= $item['sales_price']?></td>
                        <td><?= $item['sales_total_amount']?></td>
                    </tr>
                    <?php  }?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="total__text" colspan=3>Total</td>
                        <td class="total__amount"><strong>Rs <?= $totalSum;?></strong></td>
                    </tr>
                    <tr>
                        <td class="total_text_word" colspan="3">Rupees: <?= numberToWords($totalSum);?> only</td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <!-- Footer (Total and Thank You) -->
        <section class="footer">
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