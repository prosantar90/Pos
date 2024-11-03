'use strict';
$(document).ready(function() {
    setTimeout(function() {
       $(function () {
    var chart;
    var resetCssClasses = function(activeEl) {
        $(".toolbar button").removeClass('active');
        $(activeEl.target).addClass('active');
    };
    var fetchData = function (selectedRange) {
        $.ajax({
            url: 'includes/purchase/fetch-data.php',
            method: 'get',
            data: { range: selectedRange }, 
            dataType: 'json',
            success: function (data) {
                var totalItems = [], totalQty = [], totalAmount = [], purchaseDate = [];
                $.each(data, function(i, item) {
                    totalItems.push(item.items);
                    totalQty.push(item.qty);
                    totalAmount.push(item.mrp);
                    purchaseDate.push(item.pdate);
                });
                var options = {
                    chart: {
                        type: 'area',
                        height: 350,
                    },
                    series: [{
                        name: 'Items',
                        data: totalItems
                    }, {
                        name: 'Quantity',
                        data: totalQty
                    }, {
                        name: 'Amount',
                        data: totalAmount
                    }],
                    stroke: {
                        curve: 'smooth'
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    xaxis: {
                        type:'datetime',
                        categories: purchaseDate
                    }
                };

                if (!chart) {
                    chart = new ApexCharts(document.querySelector("#purchase_data"), options);
                    chart.render();
                } else {
                    chart.updateOptions(options);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    };

    // Trigger fetch on button click with appropriate range
    $("#one_monthP").on('click', function(e) {
        resetCssClasses(e);
        fetchData('1M');
    });

    $("#six_monthsP").on('click', function(e) {
        resetCssClasses(e);
        fetchData('6M');
    });
    $("#one_yearP").on('click', function(e) {
        resetCssClasses(e);
        fetchData('1Y');
    });

    $("#ytdP").on('click', function(e) {
        resetCssClasses(e);
        fetchData('YTD');
    });

    $("#allP").on('click', function(e) {
        resetCssClasses(e);
        fetchData('ALL');
    });
    fetchData('1Y');
});




      
        $(function () {
                let saleChart, resetCssClasses = function(activeEl) {
                    $(".toolbar button").removeClass('active');
                    $(activeEl.target).addClass('active');
                };
                var fetchSaleData = function (selectSaledateRange) {
                $.ajax({
                    url: 'includes/sales/fetch-data.php',
                    method: 'get',
                    data: {
                        saleRange: selectSaledateRange
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        let totalSale = [], totalSaleAmount = [], totalSaleQty = [], saleDate = [];
                        for (let i in data) {
                            totalSale.push(data[i].total_sales);
                            totalSaleAmount.push(data[i].sales_amount);
                            totalSaleQty.push(data[i].qty);
                            saleDate.push(data[i].sDate);
                        }
                         let options = {
                            chart: {
                                height: 350,
                                type: 'area',
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth'
                            },
                            series: [{
                                name: 'Total Sale',
                                data: totalSale
                            }, {
                                name: 'Sales Amount',
                                data: totalSaleAmount
                            }, {
                                name: 'Total Sale Qty',
                                data:totalSaleQty
                            }],

                             xaxis: {
                                type:'datetime',
                                categories: saleDate,
                            },
                        }

                            if (!saleChart) {
                                saleChart = new ApexCharts(document.querySelector("#sales-data"), options);
                                saleChart.render();
                            } else {
                                saleChart.updateOptions(options);
                            }    
                    }
                });
            }

             // Trigger fetch on button click with appropriate range
            $("#one_monthS").on('click', function(e) {
                resetCssClasses(e);
                fetchSaleData('1MS');
            });

            $("#six_monthsS").on('click', function(e) {
                resetCssClasses(e);
                fetchSaleData('6MS');
            });
            $("#one_yearS").on('click', function(e) {
                resetCssClasses(e);
                fetchSaleData('1YS');
            });

            $("#ytdS").on('click', function(e) {
                resetCssClasses(e);
                fetchSaleData('YTDS');
            });

            $("#allS").on('click', function(e) {
                resetCssClasses(e);
                fetchSaleData('ALLS');
            });
            fetchSaleData('1YS');
           
        });
    }, 700);
});
