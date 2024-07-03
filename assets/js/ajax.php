<script>
    $('#pro_id').on('change', function(){
        let pro_id = $(this).find(':selected').attr('data-id');     
        $.ajax({
            url: 'action.php',
            data:{pro_id:pro_id },
            method:'get',
            contentType: "application/json",
            dataType:'json',
            success:function(p){
                // console.log(p);
                $('#pro_prce').val(p.price);
                $('#pro_qty').val('1');
                $('#pro_total').val(p.price);

            }
        })
    })
    $('#pro_id').select2();
    $(document).on('change','#pro_qty',function(){
        let price = $('#pro_prce').val();
        let qty = $(this).val();
        let total =price *qty;
        $('#pro_total').val(total);
    })
    let count = $('.count').length;
    $(document).on('click','#add_row', function(e) {
        e.preventDefault();
        let pro_name = $('#pro_id').val();
        let pro_prce =$('#pro_prce').val();
        let pro_qty =$('#pro_qty').val();
        let pro_total =$('#pro_total').val();
        count++
        let html =`
                 <tr>
                    <td class="center">${count}</td>
                    <td>${pro_name}<input type="hidden" value="${pro_name}" name="product_name[]"></td>
                    <td>${pro_prce}<input type="hidden" value="${pro_prce}" name="product_price[]"></td>
                    <td>${pro_qty}<input type="hidden"  value="${pro_qty}" name="product_qty[]"></td>
                    <td>${pro_total}<input type="hidden" class="product_total" value="${pro_total}" name="product_total[]"></td>
                </tr>`;
        $('#append').append(html);
        // $('#pro_id').html(`<option value="" selected="false" disabled="disabled">Select Product</option>`);
        // $('#pro_prce, #pro_qty, #pro_total').val('');
         let sum = 0;
        $(".product_total").each(function() {
            let productTotal = parseFloat($(this).val());
            if (!isNaN(productTotal)) {
                sum += productTotal;
            }
        });
        $('.sub-total').html(sum);
        $('.sub-total-hidden').val(sum);
    })
    $(document).on('change keyup keydown','#paid-amount', function(){
        let paidAmount = $(this).val();
       let  sub_total =$('.sub-total-hidden').val();
        let grandTotal = sub_total - paidAmount;
        $('#grand-total_amount').html(grandTotal);
        $('#sales_grand_total').val(grandTotal);
    })

</script>