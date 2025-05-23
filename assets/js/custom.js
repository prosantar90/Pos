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
    /**
 * DataTable initialization
 * */

function initDataTable(selector, ajaxUrl) {
    $(selector).DataTable({
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData[0]);
        },
        "responsive": true,
        "bProcessing": true,
        "serverSide": true,
        'paging': true,
        'ordering': true,
        'order': [],
        "ajax": {
            url: ajaxUrl, // json
            type: "post",
        },
    });
}

initDataTable("#products", 'includes/products/fetch_product.php');
initDataTable("#groups", 'includes/group/fetch_group.php');
initDataTable("#customers_lists", 'includes/customers/fetch-customers.php');
initDataTable("#attendance_lists", 'includes/attendance/fetch-attendance.php');
// initDataTable("#salesManList", 'includes/home/fetch-collection-data.php');
    $('#collection_date, #manage__products, #recent_customers').DataTable({
        searching: false,
        // paging: false,
        info: false,
        dom: '<"top"f>rt<"bottom"lp><"clear">',
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
                $('#price').html(r.mrp_price);
                $('#qty').html(r.quantity);
            }
        })
    });
    /**
     * This one for sale scan your product code
     * @package
     * Best Pos Software
     */
   $(document).on('keyup input', '#pro_code', function (e) {
    e.preventDefault();
    let pro_id = $(this).val();
    if (pro_id.length > 3) {
        $.ajax({
            url: 'action.php',
            method: 'get',
            data: { pro_code: pro_id },
            contentType: "application/json",
            dataType: 'json',
            success: function (p) {
                if (p && p.product_id) {
                    let availableQty = parseInt(p.quantity);
                    
                    if (availableQty > 0) {
                        $('#code_error').hide();
                        $('#pro_id').val(p.product_id);
                        $('#pro_name').val(p.product_name);
                        $('#pro_prce').val(p.mrp_price);
                        $('#pro_qty').val('1');
                        $('#pro_total').val(p.sale_price);
                        $('#pro_prce').empty(); // Clear previous options
                        $('#pro_prce').append('<option selected="selected" value="' + p.sale_price + '">Sale Price: ' + p.sale_price + '</option>');
                        $('#pro_prce').append('<option value="' + p.wholesale_price + '">Wholesale Price: ' + p.wholesale_price + '</option>');
                        $('#pro_qty').on('input', function() {
                            let enteredQty = $(this).val();
                            if (parseInt(enteredQty) > availableQty) {
                                $('#code_error').show().html('Quantity exceeds not available stock');
                                $('#add_row').prop('disabled', true);
                            } else {
                                $('#code_error').hide();
                                $('#add_row').prop('disabled', false);
                            }
                        });
                    } else {
                        $('#code_error').show().html('Product is out of stock');
                        $('#pro_qty').val('0');
                        $('#pro_total').val('0');
                        $('#add_row').prop('disabled', true);
                    }
                } else {
                    $('#code_error').show().html('Please enter a valid product code');
                }
            },
            error: function () {
                $('#code_error').show().html('An error occurred. Please try again.');
            }
        });
    }
});    
/**
 * End Scan product code */
    
    /**
     * For purchase product using product code
     * @package
     * Best Pos Software
     * Purchase Form
     */
    /**Add multiple product using product code  */
    let count = 1;
$(document).on('click', '#add_purchase_row', function (e) {
    e.preventDefault();
    let productId = $('#product_id').val(), productName = $('#product_name').val(), mrp = $('#PrMrp').val(),PurchasPrice = $('#PurchasePrice').val(), wholeSale = $('#WholeSalePrice').val(), SalePrice = $('#SalePrice').val(),
        availableQty = $('#AvlQty').val(), CurrentQty = $('#CurrentQty').val()
        ;
    let purchaseRow = `
        <tr>
        <td>${count++}
        <input type="hidden" name="product_id[]" value="${productId}">
        <input type="hidden" name="product_av_qty[]" value="${availableQty}">
        </td>
        <td>${productName} <input type="hidden" name="product_name[]" value="${productName}"></td>
        <td>${PurchasPrice}<input type="hidden" id="purchaseTotal" name="purchasePrice[]" value="${PurchasPrice}"></td>
        <td>${SalePrice} <input type="hidden" name="salePrice[]" value="${SalePrice}"></td>
        <td>${wholeSale} <input type="hidden" name="wholePrice[]" value="${wholeSale}"></td>
        <td>${CurrentQty}  <input type="hidden" name="currentQty[]" value="${CurrentQty}"> </td>
         <td><button id="remove_this"><i class="ti-minus"></i></button></td>
        </tr>
    `;
    $('#purchaseProducts').append(purchaseRow);
    calCulatePurchase();
    $('#product_code,#product_id, #product_name, #PurchasePrice,#WholeSalePrice, #SalePrice, #AvlQty, #CurrentQty, #PrMrp').val('')
    
})
    function calCulatePurchase() {
        let sum = 0;
        $("#purchaseTotal").each(function() {
        let productTotal = parseFloat($(this).val());
            if (!isNaN(productTotal)) {
                sum += productTotal;
            }
        });  
        $('.sub-total').html(sum);
        $('.sub-total-hidden, #paid-amount').val(sum);
    }
    /**
     * Cheque Payment options
     */
$(document).on('change', '#payment_option', function (e) {
    e.preventDefault();
    let optionValue = $(this).val();
    if (optionValue == "bycheque" || optionValue == "byaccounts") {
        $('#showInputCheque').show().prop('required', true);
        $('#showInput').show().prop('required', true);
    } else {
        $('#showInput').hide().prop('required', false);
        $('#showInputCheque').hide().prop('required', false);
    }
})


    $(document).on('keyup', '#product_code', function (e) {
        e.preventDefault();
        let product_code = $(this).val();
       if (product_code.length > 3) {
                $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: { pro_code: product_code },
                    contentType: "application/json",
                    dataType: 'json',
                    success: function (p) {
                        if (p && p.product_name) {
                            $('#code_error').hide();
                            // Set the product details
                            $('#product_name').val(p.product_name);
                            $('#product_id').val(p.product_id);
                            $('#PrMrp').val(p.mrp_price);
                            $('#AvlQty').val(p.quantity);
                            $('#product_unit').val(p.unit_name);
                            $('#pro_total').val(p.mrp_price);
                        } else {
                            $('#code_error').show().html('Please enter a valid product code');
                        }
                    },
                    error: function () {
                        // Handle any AJAX request errors
                        $('#code_error').show().html('An error occurred. Please try again.');
                    }
                });
            }
    })



    /**End Purchase form ajax code */
    $(document).on('click', '#delete_customer', function (e) {  
        let cid = $(this).attr('data-id');
        handleDeletion(e, cid, { delete_customer: cid });
    })
    $(document).on('click', '#delete_user', function (e) {
        e.preventDefault();
        let uid = $(this).attr('data-id');
        handleDeletion(e, uid, { user_delete: uid });
    });


    $(document).on('click', '#delete_attendance', function (e) {
        let aid = $(this).attr('data-id');
        handleDeletion(e, aid, { attendance_delete: aid });
    });

    /**View salesman Using ajax */
    $(document).on('click', "#man_view-btn", function (e) {
        let manID = $(this).attr('data-id');
        $.ajax({
            url: 'action.php',
            method: 'post',
            data: {
                man_view: manID
            },
            success: function (r) {
                $('#man_view_box').html(r);
            },
            error: function () {
                alert('Failed to fetch details. Please try again.');
            }
        })
    });

    $(document).on('click', '#purchase__exportCsv', function (e) {
        e.preventDefault();
        let exportBtn = $(this).attr('data-id');
        $.ajax({
            url: 'action.php',
            method: 'post',
            data: {
                export_csv_purchase: exportBtn
            },
            xhrFields: {
            responseType: 'blob'
            },
            success: function(response, status, xhr) {
                let blob = new Blob([response], { type: 'text/csv' });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'purchase_data.csv';  // Name of the downloaded file
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function() {
                alert('Error downloading file');
            }
        })
    })
    

   // Reusable function for exporting CSV
function exportCsv(exportBtnSelector, dataKey, filename) {
    $(document).on('click', exportBtnSelector, function (e) {
        let exportBtn = $(this).attr('data-id');
        e.preventDefault();
        $.ajax({
            url: 'action.php',
            method: 'post',
            data: {
                [dataKey]: exportBtn
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response) {
                let blob = new Blob([response], { type: 'text/csv' });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function () {
                alert('Error downloading file');
            }
        });
    });
}

// Export CSV for different buttons
exportCsv('#customer__exportCsv', 'export_csv_customers', 'customers.csv');
exportCsv('#attendance__exportCsv', 'attendance__exportCsv', 'attendance.csv');
exportCsv('#group__exportCsv', 'group__exportCsv', 'groups-data.csv');

    /**Import Function  */
$(document).on('click', '#products__importCsv, #customer__importCsv, #supplier__importCsv, #sales__importCsv, #salesman__importCsv', function () {
    $('#imort_frm').slideToggle();
});

$(document).ready(function() {
$('#customer_name, #search_cus').keyup(function() {
    let cum_name = $(this).val();
    let targetElement = '';
    let page = '';
    if ($(this).attr('id') === 'customer_name') {
        targetElement = '#customerList';
        page = 'sales-frm';  // Sales form page
    } else if ($(this).attr('id') === 'search_cus') {
        targetElement = '#result_customer';
        page = 'customer-pay';  // Customer pay page
    }
    if (cum_name.length > 2) {
        $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {
                findCusByName: cum_name,
                page: page  // Send the page info to the server
            },
            success: function(data) {
                $(targetElement).html(data);
                $(targetElement).fadeIn();
            }
        });
    } else {
        $(targetElement).fadeOut();
    }
});
$(document).on('blur', '#customer_name', function () {
    $('#customerList').fadeOut();
});
$(document).on('blur','#search_cus', function() {
    $('#result_customer').fadeOut();
});

/**
 * get salesman for pay
 */
    $(document).on('change', '#selected_salsman', function (e) {
        e.preventDefault();
        let getId = $(this).val();
        $.ajax({
            url: 'action.php',
            method: 'post',
            data: {
                select_salesmanID: getId,
            },
            success: function (r) {
                // console.log(r);
                 $("#search__input").after(r);
            }

        })
    });

    // Click event for selecting a customer from the list on sales form
    $(document).on('click', 'li.customer-item', function() {
        $('#customer_name').val($(this).attr('data-name'));
        $('#customerList').fadeOut();
        let cum_id = $(this).attr('data-id');
        console.log(cum_id);
        $.ajax({
            url: 'action.php',
            method: 'post',
            data: {
                customer_id: cum_id
            },
            dataType:'json',
            success: function (r) {
                console.log(r);
                $('#exists_customer').val(r.cum_id);
                $('#cus_father').val(r.father_name);
                $('#cus_phone').val(r.phone_number);
                $('#cus_address').val(r.customer_address);
            }
        })
    });
    // Click event for selecting a customer from the list on Customer pay
    $(document).on('click', 'li.customer-pay-item', function() {
    // Set the customer name in the input field
    $('#search_cus').val($(this).attr('data-name'));
    $('#result_customer').fadeOut();
    let cum_id = $(this).attr('data-id');
    $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
            search_customer: cum_id
        },
        success: function (response) {
            console.log(response);
            $("#search__input").after(response);
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', error);
        }
    });
});


});

/**
 * 
 * This is modal view ajax 
 * @param {*} viewBtnSelector 
 * @param {*} dataKey 
 * @param {*} targetElement 
 */

// Function to handle AJAX requests
function loadView(viewBtnSelector, dataKey, targetElement) {
    $(document).on('click', viewBtnSelector, function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: 'action.php',
            method: 'post',
            data: {
                [dataKey]: id
            },
            success: function (response) {
                console.log(response);
                $(targetElement).html(response);
            }
        });
    });
}
loadView('#customer_view', 'getCustomerId', '#customer_views');
loadView('#group_view', 'getGroupId', '#group_views');



})



function delete_alert() {
    return confirm('Are you sure want to delete this data?');
}   
/**Delete Handle */
function handleDeletion(event, id, postData, reload = true) {
    event.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result) { // Check if confirmed
            console.log("Confirmed deletion for ID:", id);
            $.post('action.php', postData)
                .done((response) => {
                    Swal.fire({
                        title: response === 'ok' ? "Deleted!" : "Cancelled",
                        text: response === 'ok' ? "Your file has been deleted." : response,
                        icon: response === 'ok' ? "success" : "error"
                    });
                    if (response === 'ok' && reload) setTimeout(() => location.reload(), 2000);
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
}

