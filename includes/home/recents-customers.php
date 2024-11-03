<div class="table-responsive">
    <div class="customer-scroll2" style="height:420px;position:relative;">
        <table class="table table-hover m-b-0" id="recent_customers">
            <thead>
                <tr>
                    <th><span>SL</span></th>
                    <th><span>Customer Name</span></th>
                    <th><span>Father Name</span></th>
                    <th><span>Phone Number</span></th>
                    <th><span>Total Amount</span></th>
                    <th><span>Paid Amount</span></th>
                    <th><span>Due Amount</span></th>
                    <th><span>Register Date</span></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $recentCustomers= $customer->recentCustomers();
                foreach ($recentCustomers as $rcustomer) {
                ?>
                <tr>
                    <td><?= $rcustomer['cum_id'];?></td>
                    <td><?= $rcustomer['customer_name'];?></td>
                    <td><?= $rcustomer['father_name'];?></td>
                    <td><?= $rcustomer['phone_number'];?></td>
                    <td><?= $rcustomer['order_amount'];?></td>
                    <td><?= $rcustomer['order_amount_paid'];?></td>
                    <td><?= $rcustomer['order_total_amount_due'];?></td>
                    <td><?= inDateTime($rcustomer['created']);?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>