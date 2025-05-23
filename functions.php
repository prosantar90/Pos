<?php
include 'config/config.php';
function getData($sql) {
    global $conn;
    $gd = $conn->prepare($sql);
    if ($gd === false) {
        die("Error preparing query: " . $conn->error);
    }
    $gd->execute();
    $re = $gd->get_result();

    if ($re === false) {
        die("Error fetching result: " . $gd->error);
    }
    $data = array();
    while ($row = $re->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function checkInput($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlentities($data);
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




function is_home_page() {
    return basename($_SERVER['PHP_SELF']) == 'index.php';
}

function is_page($page) {
    return basename($_SERVER['SCRIPT_NAME']) == $page;
}



/**
 * Geting date and time with 
 */

function inDateTime($timestamp) {
    $date = new DateTime($timestamp, new DateTimeZone('UTC'));
    // $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
    return $date->format('d-M-y');
}

/**
 * Global Function for export csv 
 */
function export_csv($filename, $header, $query, $conn, $date_column = null, $date_format = 'Y-m-d H:i:s') {
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=' . $filename);  
    $output = fopen("php://output", "w");  
    fputcsv($output, $header);  
    $result = mysqli_query($conn, $query);  
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the date_column is provided and exists in the row
        if ($date_column && isset($row[$date_column])) {
            // Convert and format the date
            $date = new DateTime($row[$date_column]);
            $row[$date_column] = $date->format($date_format); // Format date
        }
        fputcsv($output, $row);  
    }  
    fclose($output);
}


/**
 * Salt Url for get transaction report
 */
function generateSalt($length = 16) {
    return bin2hex(random_bytes($length));
}

function createSaltedUrl($transactionId, $getdata) {
    $salt = generateSalt();
    $salted_id = $transactionId . $salt;
    $hashed_id = hash('sha256', $salted_id);
    $url = 'includes/invoices/transaction.php?' . urlencode($getdata) . '=' . urlencode($transactionId) . 
           '&salt=' . urlencode($salt) . 
           '&hash=' . urlencode($hashed_id);
    return $url;
}

