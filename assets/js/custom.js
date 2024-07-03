$(function () {
    'use strict';
    $("#login").on('click', function (e) {
        // alert('hello');
        e.preventDefault();
        $.ajax({
            method: 'post',
            url: 'action.php',
            data: $('#lfrm').serialize() + '&action=login',
            success: function (r) {
                // console.log(r);
                if ( r === 'ok') {
                   window.location='index.php';
                } else {
                    $("#err_msg").html(r)
                }
            }
        })
    });
    $('.select1').select2({
        theme: 'bootstrap4'
    });
    // View Product
    $('#products tbody').on('click', '#pro_view', function (e) {
        e.preventDefault();
        let pr_id = $(this).attr('data-id');
        $.ajax({
            url: 'action.php',
            method: 'GET',
            contentType: 'application/json',
            dataType:'json',
            data: { pr_view: pr_id },
            success: function (r) {
                console.log(r);
                $("#pr_img").attr('src',r.p_image);
                $('#name').html(r.product_name);
                $('#code').html(r.product_code);
                $('#price').html(r.price);
                $('#qty').html(r.quantity);
            }
        })
    });
    // $('#add_user').on('click', function (e) {
    //     e.preventDefault();
    //     $.ajax({
    //         method: 'post',
    //         url: 'action.php',
    //         data: $('#ufrm').serialize() + '&action=add_user',
    //         success: function (r) {
    //             console.log(r);
    //             if (r === 'ok') {
    //                 return;
    //             } else {
    //                 $("#user_error").html(r);
    //             }
    //         }
    //     })
    // })
       
    
})
function delete_alert() {
    return confirm('Are you sure want to delete this data?');
}
