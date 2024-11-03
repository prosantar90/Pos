<?php 
$purchase = new Purchase($conn);
$suppliers =new Supplier($conn);
$transaction = new Transaction($conn);
$products = new Product($conn);
/** Add new purchase
 * @package
 * Best Post Software
 */
if (isset($_POST['purchase'])) {
    $supplier_id = checkInput($_POST['supplier_name']);
    $total_purchase_amount = checkInput($_POST['purchaseTotal']);
    $purchaseInvoice = $purchase->get_purchaseInvoice_no();
    $productIds = $_POST['product_id'];
    $purchase_price = $_POST['purchasePrice'];
    $sale_price = $_POST['salePrice'];
    $wholeSale_price = $_POST['wholePrice'];
    $newQty = $_POST['currentQty'];
    $paymentOption = checkInput($_POST['PurchasePayment_mod']);
    $chequeAcoounrNo = checkInput($_POST['chequeOrAccount']);
    foreach ($productIds as $key => $id) {
        $prId = $id;
        $productDetails = $products->getProductById($prId);
        $oldqty = $productDetails['quantity'];
        $purchasePrice = $purchase_price[$key];
        $salePrice = $sale_price[$key];
        $WholesalePrice = $wholeSale_price[$key];
        $newQty = $newQty[$key];
        $totalQty = $newQty + $oldqty;

        $purData = [
            'purchase_invoice' => $purchaseInvoice,
            'product_id' => $prId,
            'product_qty' => $newQty,
            'purchase_price' => $purchasePrice,
            'sales_price' => $salePrice,
            'wholesale_price' => $WholesalePrice,
            'supplier_id' => $supplier_id,
            'purchase_total' => $total_purchase_amount,
        ];

        $runPurchase = $purchase->addPurchase($purData);
        if ($runPurchase) {
            $productData = [
                'wholesale_price' => $WholesalePrice,
                'sale_price' => $salePrice,
                'quantity' => $totalQty,
            ];
            $runProductData = $products->updateProduct($productData, $prId);
            if (!$runProductData) {
                echo 'failed update product Data';
                exit();
            }

            $supplier = $suppliers->getSupplierById($supplier_id);
            $supplierData = [
                'sup_total_amount' => $supplier['sup_total_amount'] + $total_purchase_amount,
                'sup_ad_amount'    => $supplier['sup_ad_amount'] - $total_purchase_amount,
            ];
            $sRun =$suppliers->updateSupplier($supplierData, $supplier_id);
            if(!$sRun){
                echo 'Faild to excute supplier data';
                exit();
            }
        } else {
            header('location:purchase-list.php');
               $_SESSION['res_type'] = 'danger';
               $_SESSION['response'] = 'Something wenr wrong to excute purchase';
        }
    }
     $transactionData = [
        'transaction_type'=> 'purchase_payment',
        'entity_id'      => $purchaseInvoice,
        'amount'         => $total_purchase_amount,
        'payment_mode'   => $paymentOption,
        'chequeOraccNo'  => !empty($chequeAcoounrNo) ? $chequeAcoounrNo : NULL,
        'payment_date' => date('Y-m-d H:i:s'),
    ];
    
    $allSucess = $transaction->addTransaction($transactionData);
    if ($allSucess) {
        header('location:purchase-list.php');
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Purchase products Successfully';
    }

}


   // $run = $purchase->addPurchase($data);
    // if ($run) {
    //     $updateQuery = "UPDATE products SET quantity = ? WHERE product_id = ?";
    //     $stmt = $conn->prepare($updateQuery);
    //     $stmt->bind_param("ii", $total_qty, $product_id);
    //     $stmt->execute();
    //     $stmt->close();
    //     $printCommand = "echo '$product_code' > /dev/usb/lp0"; // Adjust the path to the printer
    //     exec($printCommand); // Send print command to the printer

    //     $_SESSION['res_type'] = 'success';
    //     $_SESSION['response'] = 'Product Purchase Successfully';
    //     header('location: purchase-list.php');
    // } else {
    //     $_SESSION['res_type'] = 'danger';
    //     $_SESSION['response'] = 'Something went wrong';
    //     header('location: purchase-list.php');   
    // }

/** View purchase using id
 * @package
 * Best Post Software
 */
    $purchase_id = '';
    $pur_product_code = '';
    $pur_product_id = '';
    $pur_product_name = '';
    $pur_product_qty = '';
    $pur_product_unit = '';
    $purSupplier_id = '';
    $pur_product_price ='';
    $purchase_view = false;
if(isset($_GET['purchase_view'])){
    $id = checkInput($_GET['purchase_view']);
    $row = $purchase->getPurchaseById($id);
    $purchase_id = $row['ID'];
    $pur_product_code = $row['product_code'];
    $pur_product_id = $row['product_id'];
    $pur_product_name = $row['product_name'];
    $pur_product_qty = $row['product_qty'];
    $pur_product_unit = $row['product_unit'];
    $purSupplier_id = $row['supplier_id'];
    $purchase_view = true;
}
/**
 * @package
 * Best Post Software
 */
if (isset($_POST['purchase__id'])) {
    $purID = checkInput($_POST['purchase__id']);
    $run = $purchase->deletePurchase($purID);
    if($run ){
        echo 'ok';
    }else{
        echo 'Something went wrong';
    }
}

/**
 * Update purchase product
 * @package
 * Best POS Software
 */
if(isset($_POST['update_purchase'])){
    $purchaseID = checkInput($_POST['purchase_id']);
    $pur_proCode = checkInput($_POST['product_code']);
    $pur_proName = checkInput($_POST['product_name']);
    $pur_proQty = checkInput($_POST['product_cur_qty']);
    $pur_proUnit = checkInput($_POST['product_unit']);
    $purSupplierID= checkInput($_POST['supplier_name']);
    $puUpdate = [
        'product_code' => $pur_proCode,
        'product_name' => $pur_proName,
        'product_qty' => $pur_proQty,
        'product_unit' => $pur_proUnit,
        'supplier_id' => $purSupplierID,
    ];
    $puRUn = $purchase->updatePurchase($puUpdate, $purchaseID);
    if($puRUn){
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Product Update Successfully';
        header('location: purchase-list.php');
    } else {
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'Something went wrong';
        header('location: purchase-list.php');   
    }
}


/**
 * Export csv using core Php
 * @package
 * Best POS Software
 */

if (isset($_POST['export_csv_purchase'])) {
    $filename = 'purchase_data.csv';
    $header = array('SL No', 'Product Name', 'Product Code', 'Product Quantity', 'Product Unit', 'Supplier Name', 'Date', 'Time');
    $query = "SELECT ID, product_name, product_code, product_qty, product_unit, supplier.supplier_name, purchase_at 
              FROM purchase 
              LEFT JOIN supplier ON purchase.supplier_id = supplier.sup_ID 
              ORDER BY purchase.ID DESC";
    
    // Format the 'purchase_at' column with the date format 'd-m-Y H:i:s'
    export_csv($filename, $header, $query, $conn, 'purchase_at', 'd-m-Y');
}


if (isset($_POST['purchaseId'])) {
    $purchase__id = checkInput($_POST['purchaseId']);
    $run = $purchase->getAjaxPurchaseById($purchase__id);
    
    if ($run) {
    echo '<div class="view_pro text-center">
        <img src="'.$run['p_image'].'" id="pr_img" width="300" class="rounded">
    </div>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Code</th>
            <th>MRP</th>
            <th>Purchase Price</th>
            <th>Qty</th>
        </tr>
        <tr>
            <td id="product_name">'.$run['product_name'].'</td>
            <td id="code">'.$run['product_code'].'</td>
            <td id="mrp_price">'.$run['mrp_price'].'</td>
            <td id="purchase_price">'.$run['purchase_price'].'</td>
            <td id="qty">'.$run['product_qty'].'</td>
        </tr>
    </table>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
    ';
    }

}