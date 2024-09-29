$(function () {
    'use strict';
/**
 * DataTable initialization
 * */ 
    $('#users_list,#purchase_list').DataTable({
        responsive: true,
    });

    $("#login").on('click', function (e) {
        // alert('hello');
        e.preventDefault();
        $.ajax({
            method: 'post',
            url: 'action.php',
            data: $('#lfrm').serialize() + '&action=login',
            success: function (r) {
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

    $(document).on('keyup', '#pro_code', function (e) {
        e.preventDefault();
        // let pro_id = $(this).find(':selected').attr('data-id'); 
        let pro_id = $(this).val();
        if (pro_id.length > 3) {
            console.log('helo');
            $.ajax({
                url: 'action.php',
                method: 'get',
                data: { pro_code: pro_id },
                contentType: "application/json",
                dataType: 'json',
                success: function (p) {
                    if (p) {
                        $('#pro_name').val(p.product_name);
                        $('#pro_prce').val(p.price);
                        $('#pro_qty').val('1');
                        $('#pro_total').val(p.price);
                    } else {
                        console.log('Please enter valid Product code')
                    }
                  
                }
            })
        }
    })

    $(document).on('click', '#delete_customer', function (e) {  
        let cid = $(this).attr('data-id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(($result) => {
                if ($result) {
                    e.preventDefault();
                    $.ajax({
                        url: 'action.php',
                        method: 'get',
                        data: {
                            delete_customer: cid
                        },
                        success: function (r) {
                            if (r == 'cool') {
                                location.reload();
                            } else {
                                alert('Failed to delet customer')
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("An error occurred: " + xhr.status + " " + xhr.statusText);
                        }

                    })
                }
            })
    })

    $(document).on('click', '#delete_user', function (e) {
        e.preventDefault();
        let uid = $(this).attr('data-id');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result) {
                console.log("Confirmed deletion for user ID:", uid);
                $.post('action.php', { user_delete: uid })
                    .done((r) => {
                        Swal.fire({
                            title: r === 'ok' ? "Deleted!" : "Cancelled",
                            text: r === 'ok' ? "Your file has been deleted." : r,
                            icon: r === 'ok' ? "success" : "error"
                        });
                        if (r === 'ok') setTimeout(() => location.reload(), 2000);
                    })
                    .fail((xhr) => {
                        Swal.fire({
                            title: "Error",
                            text: "An error occurred: " + xhr.status + " " + xhr.statusText,
                            icon: "error"
                        });
                    });
            } else {
                console.log("User canceled the deletion."); // Debugging: Log cancellation
            }
        });
    });

    
})
function delete_alert() {
    return confirm('Are you sure want to delete this data?');
}   