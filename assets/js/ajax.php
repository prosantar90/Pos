<script>
    // $('#pro_id').select2();
    $(document).on('change','#pro_qty',function(){
        let price = $('#pro_prce').val();
        let qty = $(this).val();
        let total =price *qty;
        $('#pro_total').val(total);
    })
    let count = $('.count').length;
    $(document).on('click', '#add_row', function(e) {
    e.preventDefault();
    
    let pro_name = $('#pro_name').val(),
        pro_code = $('#pro_code').val(),
        pro_prce = $('#pro_prce').val(),
        pro_qty = $('#pro_qty').val(),
        pro_total = $('#pro_total').val();
    
    if(pro_code.length > 0) {
        count++;
        let html = `
            <tr>
                <td class="center">${count}</td>
                <td>${pro_name}<input type="hidden" value="${pro_name}" name="product_name[]"></td>
                <td>${pro_prce}<input type="hidden" value="${pro_prce}" name="product_price[]"></td>
                <td>${pro_qty}<input type="hidden" value="${pro_qty}" name="product_qty[]"></td>
                <td>${pro_total}<input type="hidden" class="product_total" value="${pro_total}" name="product_total[]"></td>
                <td><button id="remove_this"><i class="ti-minus"></i></button></td>
            </tr>`;
        
        $('#append').append(html);

        // Clear the input fields after adding the row
        $('#pro_code, #pro_name, #pro_prce, #pro_qty, #pro_total').val('');

        // Calculate total
        calculateTotal();
    } else {
        console.log('Please put product code');
    }
});

/**
 * Calculion Function
 * @package
 * Best Pos billing Software
 */
// Function to calculate the sum of product totals
function calculateTotal() {
    let sum = 0;
    $(".product_total").each(function() {
        let productTotal = parseFloat($(this).val());
        if (!isNaN(productTotal)) {
            sum += productTotal;
        }
    });
    
    $('.sub-total').html(sum);
    $('.sub-total-hidden, #paid-amount').val(sum);
}
    $(document).on('click', '#remove_this', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
       calculateTotal()
    });

    $(document).on('change keyup keydown','#paid-amount', function(){
        let paidAmount = $(this).val();
       let  sub_total =$('.sub-total-hidden').val();
        let grandTotal = sub_total - paidAmount;
        $('#grand-total_amount').html(grandTotal);
        $('#sales_grand_total').val(grandTotal);
    });

</script>