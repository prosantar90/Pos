<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    
                    <?php 
                    // $q = "SELECT * FROM sales WHERE  customer_id=1";
                    // $r = mysqli_query($conn,$q);
                $q ="SELECT * FROM sales WHERE  customer_id=1";
                    $r= $conn->prepare($q);
                    $r->execute();
                    $c = $r->get_result();
                    while($row=mysqli_fetch_array($c)){
                        echo $row['customer_id'].'<br>';
                    }
                    
                    ?>  
            

                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'?>