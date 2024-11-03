<div class="table-responsive">
    <div class="customer-scroll1" style="height:420px;position:relative;">
        <table class="table table-hover m-b-0" id="manage__products">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Code</th>
                    <th>Available</th>
                    <th>Alert Qty</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pr = new Product($conn);
                $products = $pr->stockAlertProduct();
                foreach ($products as $product) {
                ?>
                <tr>
                    <td><?= $product['product_id']?></td>
                    <td><?= $product['product_name']?></td>
                    <td><img width="50" class="img img-thumbnail" src="<?= $product['p_image']?>"></td>
                    <td><?= $product['product_code']?></td>
                    <td><?= $product['quantity']?></td>
                    <td><?= $product['stock_alert']?></td>
                    <td><?= inDateTime($product['product_at'])?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>