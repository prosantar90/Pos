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
function byId($sql, $id){
    global $conn;
    // $id= 8;
    // $sql ="SELECT * FROM products WHERE product_id=?";
    $ps= $conn->prepare($sql);
    $ps->bind_param('i', $id);
    $ps->execute();
    $pr= $ps->get_result();
    $row= $pr->fetch_array(MYSQLI_ASSOC);
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
function getSales(){
    global $conn;
    $sq ="SELECT sales.customer_id,customers.customer_name, SUM(sales.sales_qty) as qty, SUM(sales.sales_total_amount) as total FROM sales LEFT JOIN customers ON sales.customer_id= customers.cum_id GROUP BY sales.customer_id";
    return getData($sq);
}