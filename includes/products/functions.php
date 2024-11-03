<?php 

/**
 * Add Product 
 * @package 
 * Best Pos Software
 */
$product = new Product($conn);
if (isset($_POST['add_product'])) {
    $pname= checkInput($_POST['product_name']);
    $pcode= checkInput($_POST['product_code']);
    $brand= checkInput($_POST['brand']);
    $pcat= checkInput($_POST['p_cat']);
    $sales_unit= checkInput($_POST['sales_unit']);
    $stock_alert= checkInput($_POST['stock_alert']);
    $pprice= checkInput($_POST['price']);
    $pquantity= checkInput($_POST['quantity']);
    $pimage = $_FILES['p_image']['name'];
    $upload = 'uploads/'.$pimage;
    $q = "INSERT INTO products(product_name, product_code, brand, p_cat, sales_unit, stock_alert, mrp_price, quantity, p_image) values(?,?,?,?,?,?,?,?,?)";
    $stmt= $conn->prepare($q);
    $stmt->bind_param('sssssssss',$pname,$pcode,$brand, $pcat,$sales_unit,$stock_alert,$pprice,$pquantity,$upload);
     $stmt->execute();
    move_uploaded_file($_FILES['p_image']['tmp_name'],$upload);
    header('location:product-frm.php');
    $_SESSION['response'] = 'Product Added Successfully';
    $_SESSION['res_type'] = 'success'; 
}
/**
 * Delete Product 
 * @package 
 * Best Pos Software
 */
if (isset($_GET['p_delete'])) {
    $id = checkInput($_GET['p_delete']);
    $ps2= "SELECT p_image FROM products WHERE products.product_id=?";
    $ps2=$conn->prepare($ps2);
    $ps2->bind_param('i', $id);
    $ps2->execute();
    $pr= $ps2->get_result();
    $op= $pr->fetch_assoc();
    $imagepath=$op['p_image'];
    unlink($imagepath);

    $ps = "DELETE FROM products WHERE products.product_id= ?";
    $dp=$conn->prepare($ps);
    $dp->bind_param('i',$id);
    $dp->execute();
    header('location:product-list.php');
     $_SESSION['response'] = 'Product deleted Successfully';
    $_SESSION['res_type'] = 'danger'; 
}
/**
 * View Product 
 * @package 
 * Best Pos Software
 */
if (isset($_GET['pr_view'])) {
    $id = checkInput($_GET['pr_view']);
    $pv= "SELECT products.product_id, products.product_name, products.product_code, products.brand, products.p_cat, products.sales_unit, products.stock_alert,brand.brand_name, units.unit_name, categories.category_name, products.mrp_price,products.quantity, products.p_image FROM products 
        LEFT JOIN brand ON products.brand= brand.b_id
        LEFT JOIN units ON products.sales_unit= units.unit_id
        LEFT JOIN categories ON products.p_cat= categories.cat_id
        WHERE products.product_id=?";
    $ps= $conn->prepare($pv);
    $ps->bind_param('i', $id);
    $ps->execute();
    $pr= $ps->get_result();
    $row= $pr->fetch_array(MYSQLI_ASSOC);
    if ($row >0 ) {
        echo json_encode($row);
    }
}
/**
 * Update Product 
 * @package 
 * Best Pos Software
 */

if (isset($_POST['up_product'])) {
    $id = checkInput($_POST['pr_id']);
    $pname= checkInput($_POST['product_name']);
    $pcode= checkInput($_POST['product_code']);
    $brand= checkInput($_POST['brand']);
    $pcat= checkInput($_POST['p_cat']);
    $sales_unit= checkInput($_POST['sales_unit']);
    $stock_alert= checkInput($_POST['stock_alert']);
    $pprice= checkInput($_POST['price']);
    $pquantity= checkInput($_POST['quantity']);
    // $pimage = $_FILES['p_image']['name'];
    $oldimage = checkInput($_POST['oldprimg']);

    if(isset($_FILES['p_image']['name']) && ($_FILES['p_image']['name'] !='')){
        $newimage ="uploads/".$_FILES['p_image']['name'];
        if (file_exists($oldimage)) {
         unlink($oldimage);
        }
        // unlink($oldimage);
        move_uploaded_file($_FILES['p_image']['tmp_name'],$newimage);
    }else{
        $newimage =$oldimage;
    }
    $query = "UPDATE products SET product_name=?, product_code=?, brand=?, p_cat=?, sales_unit=?, stock_alert=?, mrp_price=?, quantity=?, p_image=? WHERE product_id=?";
    $stmt= $conn->prepare($query);
    $stmt->bind_param('sssssssssi',$pname,$pcode,$brand, $pcat,$sales_unit,$stock_alert,$pprice,$pquantity,$newimage, $id);
    $stmt->execute();
    header('location:product-frm.php?p_view='.$id);
     $_SESSION['response'] = 'Product Updated Successfully';
    $_SESSION['res_type'] = 'success'; 
}
/**
 * View Product 
 * @package 
 * Best Pos Software
 */
    $pr_update= false;
    $pr_id=   '';
    $pr_name= '';
    $pr_code= '';
    $pr_unit= '';
    $br_id= '';
    $pr_cat= '';
    $pr_unit = '';
    $pr_stock = '';
    $pr_price = '';
    $pr_qty = '';
    $pr_image ='';
if (isset($_GET['p_view'])) {
    $id = checkInput($_GET['p_view']);
    
    $pv = "SELECT products.product_id, products.product_name, products.product_code, products.brand AS brand_id, 
           products.p_cat, products.sales_unit, products.stock_alert, brand.brand_name, 
           units.unit_name, categories.category_name, products.mrp_price, 
           products.quantity, products.p_image 
           FROM products 
           LEFT JOIN brand ON products.brand = brand.b_id
           LEFT JOIN units ON products.sales_unit = units.unit_id
           LEFT JOIN categories ON products.p_cat = categories.cat_id
           WHERE products.product_id = ?";
    
    $ps = $conn->prepare($pv);
    $ps->bind_param('i', $id);
    $ps->execute();
    $pr = $ps->get_result();
    $row = $pr->fetch_array(MYSQLI_ASSOC);
     echo 'Brand ID: ' . $row['brand_id'];
    $pr_id = $row['product_id'];
    $pr_name = $row['product_name'];
    $pr_code = $row['product_code'];
    $pr_unit = $row['unit_name'];
    $br_id = $row['brand_id']; // Ensure this is correctly fetched
    $pr_cat = $row['p_cat'];
    $pr_unit = $row['sales_unit'];
    $pr_stock = $row['stock_alert'];
    $pr_price = $row['mrp_price'];
    $pr_qty = $row['quantity'];
    $pr_image = $row['p_image'];
    $pr_update = true;
}

/**
 * export csv
 */
 if (isset($_POST['export_csv_product'])) {
    $filename = 'purchase_data.csv';
    $header = array('SL No', 'Product Name', 'Product Code', 'Brand Name','Categories','Product Unit','Stock Alert','Mrp Price','Product Quantity', 'Product Image','Status','Date');
    $query = "SELECT product_id, product_name, product_code,brand.brand_name,categories.category_name,units.unit_name,products.stock_alert, products.mrp_price, products.quantity,products.p_image,products.p_status, products.p_status,'products.product_at'  FROM products
    LEFT JOIN categories ON products.p_cat = categories.cat_id 
    LEFT JOIN units ON products.sales_unit = units.unit_id 
    LEFT JOIN brand ON products.brand = brand.b_id 
    ";
    // Format the 'purchase_at' column with the date format 'd-m-Y H:i:s'
    export_csv($filename, $header, $query, $conn, 'product_at', 'd-m-Y');
 }



// Function to get or insert brand ID
function getBrandId($brand_name, $conn) {
    $stmt = $conn->prepare("SELECT b_id FROM brand WHERE brand_name = ?");
    $stmt->bind_param('s', $brand_name);
    $stmt->execute();
    $stmt->bind_result($brand_id);
    if ($stmt->fetch()) {
        return $brand_id;
    } else {
        $status = 1;
        $stmt = $conn->prepare("INSERT INTO brand (brand_name, brand_status) VALUES (?,?)");
        $stmt->bind_param('si', $brand_name, $status);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

// Function to get or insert unit ID
function getUnitId($unit_name, $conn) {
    $stmt = $conn->prepare("SELECT unit_id FROM units WHERE unit_name = ?");
    $stmt->bind_param('s', $unit_name);
    $stmt->execute();
    $stmt->bind_result($unit_id);
    if ($stmt->fetch()) {
        return $unit_id;
    } else {
        $status = 1;
        $stmt = $conn->prepare("INSERT INTO units (unit_name, unit_status) VALUES (?,?)");
        $stmt->bind_param('si', $unit_name, $status);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

// Function to get or insert category ID
function getProCatId($proCatName, $conn) {
    $stmt = $conn->prepare("SELECT cat_id FROM categories WHERE category_name = ?");
    $stmt->bind_param('s', $proCatName);
    $stmt->execute();
    $stmt->bind_result($cat_id);
    if ($stmt->fetch()) {
        return $cat_id;
    } else {
        $status = 1;
        $stmt = $conn->prepare("INSERT INTO categories (category_name, cat_status) VALUES (?,?)");
        $stmt->bind_param('si', $proCatName, $status);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

if (isset($_POST['import_products'])) {
    $file = $_FILES['import_csv_product']['tmp_name'];
    $csvMimes = array(
        'text/x-comma-separated-values', 'text/comma-separated-values',
        'application/octet-stream', 'application/vnd.ms-excel',
        'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv',
        'application/excel', 'application/vnd.msexcel', 'text/plain'
    );
    if (in_array($_FILES['import_csv_product']['type'], $csvMimes)) {
        $ofile = fopen($file, 'r');

        // Skip the first row (header row)
        $headers = fgetcsv($ofile);  // This reads the first row but doesn't process it.

        // Process remaining rows
        while (($data = fgetcsv($ofile, 1000, ',')) !== false) {
            $product_name = $data[1];
            $product_code = $data[2];
            $brand_name = $data[3];
            $proCatName = $data[4];
            $unit_name = $data[5];
            $stock_alert = $data[6];
            $mrp_price = $data[7];
            $quantity = $data[8];
            $productImg = $data[9];
            $productStatus = $data[10];
            $product_at = date('Y-m-d H:i:s');

            $brand_id = getBrandId($brand_name, $conn);
            $pcat_id = getProCatId($proCatName, $conn);
            $sales_unit = getUnitId($unit_name, $conn);

            $product_data = [
                'product_name' => $product_name,
                'product_code' => $product_code,
                'brand' => $brand_id,
                'p_cat' => $pcat_id,
                'sales_unit' => $sales_unit,
                'stock_alert' => $stock_alert,
                'mrp_price' => $mrp_price,
                'quantity' => $quantity,
                'p_image' => $productImg,
                'p_status' => $productStatus,
                'product_at' => $product_at,
            ];

            // Insert product into database
            $run = $product->addProducts($product_data);
            if (!$run) {
                echo "Error inserting product '$product_name': " . $conn->error . "<br>";
            }
        }

        fclose($ofile);

        // Set session success message
        $_SESSION['res_type'] = 'success';
        $_SESSION['response'] = 'Products added successfully';
        header('Location: product-list.php');
        exit();
    } else {
        echo "Invalid file type.";
    }
}
