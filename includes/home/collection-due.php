<div class="table-responsive">
    <div class="customer-scroll" style="height:420px;position:relative;">
        <table class="table table-hover m-b-0" id="collection_date">
            <thead>
                <tr>
                    <th><span>Sl</span></th>
                    <th><span>Customer Name <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
                    <th><span>Father Name<a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
                    <th><span>Phone Number<a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
                    <th><span>Paid Amount <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
                    <th><span>Due Amount <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
                    <th><span>Promise Date <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
                    <th><span>Action <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $customer = new customers($conn);
                    $customers= $customer->promiseDate();
                    foreach ($customers as $cus) {
                ?>
                <tr>
                    <td><?= $cus['cum_id']?></td>
                    <td>
                        <?= $cus['customer_name']?>
                    </td>
                    <td>
                        <?= $cus['father_name']?>
                    </td>
                    <td>
                        <?= $cus['phone_number']?>
                    </td>
                    <td>
                        <?= $cus['order_amount_paid']?>
                    </td>
                    <td><?= $cus['order_total_amount_due'];?></td>
                    <td><?= $cus['promis_date'];?></td>
                    <td>
                    <a id="pay__now" data-id="<?= $cus['cum_id']; ?>" data-toggle="modal" data-target="#pr_view" class="badge badge-primary p-2" href="javascript:void(0)">Pay Now</a>
                    </td>
                </tr>
                <?php }?>
                    
            </tbody>
        </table>
    </div>
</div>
<!-- View Purchase product -->
<div class="modal" id="pr_view">
    <div class="modal-dialog content-width">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Customer Pay</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-bodi p-3" id="customer_payment">
                                                   
            </div>
        </div>
    </div>
</div>
