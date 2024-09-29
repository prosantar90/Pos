<?php
include 'config/config.php';
function getData($sql){
    global $conn;
    $gd= $conn->prepare($sql);
    $gd->execute();
    $re = $gd->get_result();
    $data= array();
   while($row=mysqli_fetch_array($re)){
    $data[]=$row;
    }
    return $data;
}
function alertMsg(){
    if (isset($_SESSION['response'])) {
    ?>
    <div class="alert alert-<?= $_SESSION['res_type'];?> alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $_SESSION['response'];?>
    </div>    
    <?php } unset($_SESSION['response']);
}
 
function numberToWords($number) {
    $words = [];
    // Arrays for number words
    $units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
    $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
    $scales = ['', 'Thousand', 'Lakh', 'Core', 'Trillion'];

    // Handle zero
    if ($number == 0) {
        return 'Zero';
    }

    // Handle negative numbers
    if ($number < 0) {
        return 'Negative ' . numberToWords(abs($number));
    }

    // Break the number into chunks of 3 digits
    $numStr = str_pad($number, ceil(strlen($number) / 3) * 3, '0', STR_PAD_LEFT);
    $numChunks = str_split($numStr, 3);
    $chunkCount = count($numChunks);

    foreach ($numChunks as $i => $chunk) {
        $chunk = (int) $chunk;
        if ($chunk > 0) {
            $hundreds = floor($chunk / 100);
            $remainder = $chunk % 100;
            $chunkText = '';

            // Add hundreds
            if ($hundreds > 0) {
                $chunkText .= $units[$hundreds] . ' Hundred ';
            }

            // Add tens and units
            if ($remainder > 0) {
                if ($remainder < 20) {
                    $chunkText .= $units[$remainder] . ' ';
                } else {
                    $chunkText .= $tens[floor($remainder / 10)] . ' ' . $units[$remainder % 10] . ' ';
                }
            }

            $scaleIndex = $chunkCount - $i - 1;
            if ($scaleIndex > 0) {
                $chunkText .= $scales[$scaleIndex] . ' ';
            }

            $words[] = $chunkText;
        }
    }

    return trim(implode(' ', $words));
}

function byId($sql, $id){
    global $conn;
    $ps= $conn->prepare($sql);
    $ps->bind_param('i', $id);
    $ps->execute();
    $pr= $ps->get_result();
    $row= $pr->fetch_array(MYSQLI_ASSOC);
    return $row;
}


function showinvoice($sql, $id){
      global $conn;
        $ps= $conn->prepare($sql);
        $ps->bind_param('i', $id);
        $ps->execute();
        $pr= $ps->get_result();
        $row= $pr->fetch_all(MYSQLI_ASSOC);
        return $row;
}

function showAll_sales(){
    $sq = "SELECT * FROM sales";
    return getData($sq);
}
function show_products(){
    $sql = "SELECT * FROM products";
    return getData($sql);
    
}
function getProductById($id){
    $sql ="SELECT * FROM products WHERE product_id=?";
    $row= byId($sql, $id);
    return $row;
}
function getProductByCode($code){
    global $conn;
    $sql ="SELECT * FROM products WHERE product_code=?";
    $ps= $conn->prepare($sql);
    $ps->bind_param('s', $code);
    $ps->execute();
    $pr= $ps->get_result();
    $row= $pr->fetch_array(MYSQLI_ASSOC);
    return $row;
}
function getSales(){
    global $conn;
    // $sq ="SELECT sales.customer_id,customers.customer_name, SUM(sales.sales_qty) as qty, SUM(sales.sales_total_amount) as total FROM sales LEFT JOIN customers ON sales.customer_id= customers.cum_id GROUP BY sales.customer_id";
    $sq ="SELECT sales.sales_invoice,sales.customer_id,customers.customer_name, SUM(sales.sales_qty) as qty, SUM(sales.sales_total_amount) as total, created_at FROM sales LEFT JOIN customers ON sales.customer_id= customers.cum_id GROUP BY sales.sales_invoice";
    return getData($sq);
}
function get_sales_no(){
     $sql = "SELECT sales_invoice FROM sales ORDER BY sales_invoice DESC LIMIT 1";
     $getid = getData($sql);
     $invoice_no = 0001;
     foreach ($getid as $id) {
     $invoice_no= $id['sales_invoice'];
     }
    $invoice_no++;
    $formatted_invoice_no = sprintf('%04d', $invoice_no); 
    return $formatted_invoice_no;
}