@extends('layouts.app')
@section('content')

<style>
    .select2-container {
        width: 100% !important;
    }

#invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>

<!------ Include the above in your HEAD tag ---------->

<!--Author      : @arboshiki-->
<div id="invoice">

    <div class="invoice overflow-auto">
     <form method="post" id="form_add" action="{{ url('/invoice/store/manual/invoice') }}" enctype="multipart/form-data" name="Form" class="form-horizontal upperform saleAddForm">
                        <div class="col-md-12 col-xs-12 col-sm-12 form-group my-form-group has-feedback">
                            <div class="col-md-2 col-sm-6 col-xs-12  ">
                                <h4><b>{{ trans('app.Invoice Details')}}</b></h4>
                                <hr>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12  ">
                                <select class="form-control  select_customer" name="customerlist" id="customerlist" required>
                                    <option value="" disabled selected>{{ trans('Select customers')}}</option>
                                    @foreach ($customers_list as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} / {{$customer->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12  ">
                                <select class="form-control  select_car" name="carlist" id="carlist" required>
                                    <option value="" disabled selected>{{ trans('Select Car')}}</option>
                                    <!--@foreach ($customers_list as $customer)
											   <option value="{{ $customer->id }}">{{ $customer->name }} / {{$customer->phone }}</option>
											@endforeach-->
                                </select>
                            </div>

                        </div>
        <div style="min-width: 600px">
            <header>
                <div class="row">
                   
                    <div class="col company-details">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                Branch Name <br>{{ trans('اسم الفرع')}} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" name="branch_name" class="form-control" value="{{ $auth_branch->branch_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                Vat Number: <br> الرقم الضريبى <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="vat_number" name="vat_number" value="{{$auth_branch_vat_number}}" class="form-control" readonly>
                            </div>
                        </div>
                         <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Invoice Number') }} <br>{{ trans('رقم الفاتورة')}} <label class="color-danger">*</label></label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <input type="text" class="form-control" value="{{ '#'.Auth::user()->branch_id }}" readonly>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <input type="text" name="Invoice_Number" class="form-control" value="{{ $code }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">Customer:</div>
                         <div class="to{{$errors->has('Customer') ? 'error' : null}}">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Customer Name') }} <br>{{ trans('اسم الزبون')}} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-sm-8 col-xs-12 ">
                                <input type="text" name="Customer" id="name" class="form-control" value="{{old('Customer')}}" readonly>
                                            @if($errors->has('Customer'))
                                            <span class="help-block" style="color:red;">{{$errors->first('Customer')}}</span>
                                            @endif
                            </div>
                        </div>
                         <div class="address {{$errors->has('customer_address') ? 'error' : null}}">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Customer Address <br>{{ trans('عنوان العميل')}}<label class="color-danger">*</label></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" id="address" name="customer_address" class="form-control" value="{{old('customer_address')}}" readonly>
                                    @if($errors->has('customer_address'))
                                        <span class="help-block" style="color:red;">{{$errors->first('customer_address')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                         <div class="col-md-12 col-sm-12 col-xs-12 form-group {{$errors->has('customer_phone') ? 'error' : null}}">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Customer Phone <br>{{ trans('هاتف العميل')}} <label class="color-danger">*</label></label>
                                        <div class="col-md-2 col-sm-8 col-xs-12">
                                            <input type="text" name="phone_code" class="form-control" value="+966" readonly>
                                        </div>
                                        <div class="col-md-6 col-sm-8 col-xs-12">
                                            <input type="text" id="phone" name="customer_phone" class="form-control" value="{{old('customer_phone')}}" readonly>
                                            @if($errors->has('customer_phone'))
                                            <span class="help-block" style="color:red;">{{$errors->first('customer_phone')}}</span>
                                            @endif
                                        </div>
                                    </div>
                        </div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE 3-2-1</h1>
                        <div class="date">Date of Invoice: 01/10/2018</div>
                        <div class="date">Due Date: 30/10/2018</div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-right">HOUR PRICE</th>
                            <th class="text-right">HOURS</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="no">04</td>
                            <td class="text-left"><h3>
                                <a target="_blank" href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                Youtube channel
                                </a>
                                </h3>
                               <a target="_blank" href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                   Useful videos
                               </a> 
                               to improve your Javascript skills. Subscribe and stay tuned :)
                            </td>
                            <td class="unit">$0.00</td>
                            <td class="qty">100</td>
                            <td class="total">$0.00</td>
                        </tr>
                        <tr>
                            <td class="no">01</td>
                            <td class="text-left"><h3>Website Design</h3>Creating a recognizable design solution based on the companys existing visual identity</td>
                            <td class="unit">$40.00</td>
                            <td class="qty">30</td>
                            <td class="total">$1,200.00</td>
                        </tr>
                        <tr>
                            <td class="no">02</td>
                            <td class="text-left"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
                            <td class="unit">$40.00</td>
                            <td class="qty">80</td>
                            <td class="total">$3,200.00</td>
                        </tr>
                        <tr>
                            <td class="no">03</td>
                            <td class="text-left"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
                            <td class="unit">$40.00</td>
                            <td class="qty">20</td>
                            <td class="total">$800.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>$5,200.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX 25%</td>
                            <td>$1,300.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>$6,500.00</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>


<!-- Scripts starting -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

<script>
    $(document).ready(function() {

        /*datetimepicker*/
        $('.datepicker').datetimepicker({
            format: "<?php echo getDatepicker(); ?>"
            , autoclose: 1
            , minView: 2
        , });


        // Initialize select2
        $("#selUser").select2();


        $('#form_add').submit(function() {

            var dis = $('#disc').val();

            var msg1 = "{{ trans('app.Discount Rate')}}";
            var msg2 = "{{ trans('app.Percentage must be less than or equal to 100')}}";

            if (dis > 100) {
                //alert('Percentage must be less than or equal to 100');
                swal({
                    title: msg1
                    , text: msg2
                });
                return false;
            }
        });


        /*For JobCard Number*/
        $('body').on('change', '.select_cus', function() {
            var type = $(".invoicetype option:selected").val();
            var msg3 = "{{ trans('app.Invoice Alert')}}";
            var msg4 = "{{ trans('app.Invoice is already created...')}}";

            if (type == 0) {
                var url = $(this).attr('customer_url');
                var cus_name = $('.select_cus :selected').val();

                $.ajax({
                    type: 'GET'
                    , url: url
                    , data: {
                        cus_name: cus_name
                    },

                    success: function(response) {
                        if ($.trim(response) == '') {
                            //alert("Invoice is already created...");
                            swal({
                                title: msg3
                                , text: msg4
                            });

                            $('.job_number').html('<option value="">Select Jobcard</option>');
                            return false;
                        }
                        $('.job_number').html('<option value="">Select Jobcard</option>');
                        $('.job_number').append(response);
                        $('.ttl_amount').val('0');
                        $('#grandtotal').val('0');
                    }
                    , error: function(e) {
                        console.log(e);
                    }
                });
            } else {
                var vehi_url = $(this).attr('vehicle_url');
                var cus_name = $('.select_cus :selected').val();
                $.ajax({
                    type: "GET"
                    , url: vehi_url
                    , data: {
                        cus_name: cus_name
                    }
                    , success: function(response) {
                        if ($.trim(response) == '') {
                            //alert("Invoice is already created...");
                            swal({
                                title: msg3
                                , text: msg4
                            });

                            $('.vehi_name').html('<option value="">Select Vehicle</option>');
                            return false;
                        }
                        $('.vehi_name').html('<option value="">Select Vehicle</option>');
                        $('.vehi_name').append(response);
                        $('.ttl_amount').val('0');
                        $('#grandtotal').val('0');
                    }
                    , error: function(e) {
                        console.log(e);
                    }
                });
            }
        });

        //change jobcard number
        $('body').on('change', '.job_number', function() {

            var url = $(this).attr('job_url');
            var job_no = $('.job_number :selected').val();
            $.ajax({
                type: 'GET'
                , url: url
                , data: {
                    job_no: job_no
                }
                , success: function(response) {
                    $('.ttl_amount').val(response[1]);
                    $('.servi_id').val(response[0]);
                    var total = $('.ttl_amount').val();
                    var disc = $('#disc').val();
                    if (disc != '') {
                        var discount = (parseFloat(total) * parseFloat(disc)) / 100;
                    } else {
                        var discount = 0;
                    }

                    var final = 0;
                    $('.myCheckbox:checked').each(function() {
                        var values = $(this).attr('taxrate');
                        final = parseFloat(values) + parseFloat(final);
                    });

                    var totalamount = parseFloat(total) - parseFloat(discount);
                    var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
                    var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);
                    $('#grandtotal').val(grandtotal);
                }
                , error: function(e) {
                    console.log(e);
                }
            });
        });


        //change vehicle name 
        $('body').on('change', '.vehi_name', function() {

            var vehicle_url = $(this).attr('vehicle_amt');
            var vehi_id = $('.vehi_name :selected').val();

            $.ajax({
                type: 'GET'
                , url: vehicle_url
                , data: {
                    vehi_id: vehi_id
                },

                success: function(response) {
                    $('.ttl_amount').val(response[1]);
                    $('.servi_id').val(response[0]);
                    var total = $('.ttl_amount').val();
                    var disc = $('#disc').val();
                    if (disc != '') {
                        var discount = (parseFloat(total) * parseFloat(disc)) / 100;
                    } else {
                        var discount = 0;
                    }

                    var final = 0;
                    $('.myCheckbox:checked').each(function() {
                        var values = $(this).attr('taxrate');
                        final = parseFloat(values) + parseFloat(final);
                    });

                    var totalamount = parseFloat(total) - parseFloat(discount);
                    var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
                    var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);
                    $('#grandtotal').val(grandtotal);
                }
                , error: function(e) {
                    console.log(e);
                }
            });
        });


        /* on keyup in discount*/
        $('body').on('keyup', '#disc', function() {

            var msg1 = "{{ trans('app.Discount Rate')}}";
            var msg2 = "{{ trans('app.Percentage must be less than or equal to 100')}}";
            var total1 = $('.ttl_amount').val();
            if (total1 != '') {
                var total = total1;
            } else {
                var total = 0;
            }

            var disc = $('#disc').val();
            var discount = 0;
            if (disc != '') {
                if (disc > 100) {
                    //alert('Percentage must be less than or equal to 100');
                    swal({
                        title: msg1
                        , text: msg2
                    });
                    $('#disc').val(0);
                    discount = 0;
                } else {
                    discount = (parseFloat(total) * parseFloat(disc)) / 100;
                }
            } else {
                discount = 0;
            }

            var final = 0;

            $('.myCheckbox:checked').each(function() {
                var values = $(this).attr('taxrate');
                final = parseFloat(values) + parseFloat(final);
            });

            var totalamount = parseFloat(total) - parseFloat(discount);
            var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
            var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);

            $('#grandtotal').val(grandtotal);
        });



        // changes taxt
        $('body').on('click', '.myCheckbox', function() {

            var total1 = $('.ttl_amount').val();

            if (total1 != '') {
                var total = total1;
            } else {
                var total = 0;
            }

            var disc = $('#disc').val();
            if (disc != '') {
                var discount = (parseFloat(total) * parseFloat(disc)) / 100;

            } else {
                var discount = 0;
            }

            var final = 0;
            $('.myCheckbox:checked').each(function() {
                var values = $(this).attr('taxrate');
                final = parseFloat(values) + parseFloat(final);
            });

            var totalamount = parseFloat(total) - parseFloat(discount);
            var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
            var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);

            $('#grandtotal').val(grandtotal);
        });


        //-------if redirect from jobcard list-------
        var sales_list_id = $('#sales_list_id').val();

        if (sales_list_id != null) {
            $("#form_fields").show();
            $("#vehicle").show();
            $("#job").hide();
            $("#getid").hide();
            $("#vhi").removeAttr('required', true);
            $("#jobcard").attr('required', false);
        }

        //-------if redirect from jobcard list-------
        var job_list_no = $('#jobcard_list_job').val();
        if (job_list_no != null) {
            $("#form_fields").show();
            $("#vehicle").hide();
            $("#getid").hide();
            $("#job").show();
            $("#vhi").removeAttr('required', false);
            $("#jobcard").attr('required', true);
        }


        var ttl_amount = $('.ttl_amount').val();
        var ttl_amount1 = $('#grandtotal').val(ttl_amount);

        //--------------------------------------------
        $('body').on('change', '.invoicetype', function() {

            var type = $(".invoicetype option:selected").val();
            $('#form_fields').slideDown(900);
            if (type == 0) {
                $("#vehicle").hide();
                $("#job").show();
                $("#vhi").removeAttr('required', false);
                $("#jobcard").attr('required', true);
            } else {
                $("#job").hide();
                $("#vehicle").show();
                $("#jobcard").removeAttr('required', false);
                $("#vhi").attr('required', true);
            }
            var sales_url = $(this).attr('sales_url');

            $.ajax({
                type: 'GET'
                , url: sales_url
                , data: {
                    type: type
                }
                , success: function(response) {
                    $('.customer_name').html("");
                    $('.customer_name').html('<option value="">{{ trans('
                        app.Select Customer ')}}</option>');
                    $('.customer_name').append(response);
                }
                , error: function(e) {
                    console.log(e);
                }
            });
        });

        // Initialize select2
        $("#customer_select_box").select2();


        var type = $(".invoicetype option:selected").val();
        if (type == null) {} else {
            $('#customer_select_box').removeClass("select_customer_auto_search");
        }


        /*When option selected as an unpaid after paid amount textbox is disable*/
        $('body').on('change', '.paymentStatusSelect', function() {

            var statusValue = $('select[name=Status]').val();
            var grandTotalValue = $('.grandtotal').val();

            if (statusValue != null) {
                if (statusValue == 1) {
                    $('.paidAmountMainDiv').css({
                        "display": ""
                    });
                    $('.paymentTypeMainDiv').css({
                        "display": ""
                    });
                    $('.paidamount').val(grandTotalValue / 2);
                } else if (statusValue == 2) {
                    $('.paidAmountMainDiv').css({
                        "display": ""
                    });
                    $('.paymentTypeMainDiv').css({
                        "display": ""
                    });
                    $('.paidamount').val(grandTotalValue);
                } else if (statusValue == 0) {
                    $('.paidAmountMainDiv').css({
                        "display": "none"
                    });
                    $('.paymentTypeMainDiv').css({
                        "display": "none"
                    });
                    $('.paidamount').val("");
                    $('.paymentType').val("");
                }
            }
        });



        /* discount field accept only numbers */
        $('body').on('keyup', '.discount', function() {

            var discountAmt = $(this).val();
            var rgx = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;

            if (discountAmt > 100) {
                $(this).val(0);
            } else if (!discountAmt.replace(/\s/g, '').length) {
                $(this).val("");
            } else if (!rgx.test(discountAmt)) {
                $(this).val("");
            }
        });


        //paid amount
        $('body').on('keyup', '.paidamount', function() {

            var paidamount = $(this).val();
            var totalgrand = $('#grandtotal').val();
            var statusValue = $('select[name=Status]').val();

            var rgs = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;

            var msg5 = "{{ trans('app.Pay Amount')}}";
            var msg6 = "{{ trans('app.Please pay half or less than grand total amount, because you select half pay')}}";
            var msg7 = "{{ trans('app.Please pay only grand total amount, because you select full pay')}}";

            if (statusValue == 1) {
                if (parseInt(paidamount) > parseInt(totalgrand)) {
                    $(this).val(totalgrand / 2);
                    //alert("Please pay half or less than grand total amount, because you select half pay");
                    swal({
                        title: msg5
                        , text: msg6
                    });
                } else if (parseInt(paidamount) == parseInt(totalgrand)) {
                    $(this).val(totalgrand / 2);
                    //alert("Please pay half or less than grand total amount, because you select half pay");
                    swal({
                        title: msg5
                        , text: msg6
                    });
                } else if (parseInt(paidamount) == 0) {
                    $(this).val(totalgrand / 2);
                    swal({
                        title: msg5
                        , text: msg6
                    });
                } else if (!paidamount.replace(/\s/g, '').length) {
                    $(this).val("");
                    /*swal({   
                    	title: "Invalid Input Alert",
                    	text: 'Please enter only numeric data'
                    });*/
                } else if (!rgs.test(paidamount)) {
                    $(this).val("");
                    /*swal({   
                    	title: "Invalid Input Alert",
                    	text: 'Please enter only numeric data'
                    });*/
                }
            } else if (statusValue == 2) {
                if (parseInt(paidamount) > parseInt(totalgrand)) {
                    $(this).val(totalgrand);
                    //alert("Please pay only grand total amount, because you select full pay");
                    swal({
                        title: msg5
                        , text: msg7
                    });
                } else if (parseInt(paidamount) < parseInt(totalgrand)) {
                    $(this).val(totalgrand);
                    //alert("Please pay only grand total amount, because you select full pay");
                    swal({
                        title: msg5
                        , text: msg7
                    });
                } else if (parseInt(paidamount) == 0) {
                    $(this).val(totalgrand / 2);
                    swal({
                        title: msg5
                        , text: msg7
                    });
                } else if (!paidamount.replace(/\s/g, '').length) {
                    $(this).val("");
                    /*swal({   
                    	title: "Invalid Input Alert",
                    	text: 'Please enter only numeric data'
                    });*/
                } else if (!rgs.test(paidamount)) {
                    $(this).val("");
                    /*swal({   
                    	title: "Invalid Input Alert",
                    	text: 'Please enter only numeric data'
                    });*/
                }
            }

            /*if(parseInt(paidamount) <= parseInt(totalgrand))
            {
            	
            }
            else{
            	swal({   
            		title: "Pay Amount",
            		text: 'Please enter an amount less than total amount'  

            	});
            	var paidamount = $(this).val('');		
            	return false;					
            }*/

        });



        /*If select box have value then error msg and has error class remove*/
        $('body').on('change', '.invoiceDate', function() {

            var dateValue = $(this).val();

            if (dateValue != null) {
                $('#date_of_birth-error').css({
                    "display": "none"
                });
            }

            if (dateValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });

        /*If select box have value then error msg and has error class remove*/
        $('body').on('change', '.job_open_date', function() {

            var dateValue = $(this).val();

            if (dateValue != null) {
                $('#date_of_birth-error').css({
                    "display": "none"
                });
            }

            if (dateValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });

        /*If select box have value then error msg and has error class remove*/
        $('body').on('change', '.delivery_date', function() {

            var dateValue = $(this).val();

            if (dateValue != null) {
                $('#date_of_birth-error').css({
                    "display": "none"
                });
            }

            if (dateValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });


        $('.customer_name').on('change', function() {

            var customerValue = $('select[name=Customer]').val();

            if (customerValue != null) {
                $('#customer_select_box-error').css({
                    "display": "none"
                });
            }

            if (customerValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });



        /*Custom Field manually validation*/
        var msg1 = "{{ trans('app.field is required')}}";
        var msg2 = "{{ trans('app.Only blank space not allowed')}}";
        var msg3 = "{{ trans('app.Special symbols are not allowed.')}}";
        var msg4 = "{{ trans('app.At first position only alphabets are allowed.')}}";

        /*Form submit time check validation for Custom Fields */
        $('body').on('click', '.submitButton', function(e) {
            $('#form_add input, #form_add select, #form_add textarea').each(

                function(index) {
                    var input = $(this);

                    if (input.attr('name') == "Customer" || input.attr('name') == "Job_card" || input.attr('name') == "Date" || input.attr('name') == "Status") {
                        if (input.val() == "") {
                            return false;
                        }
                    } else if (input.attr('isRequire') == 'required') {
                        var rowid = (input.attr('rows_id'));
                        var labelName = (input.attr('fieldnameis'));

                        if (input.attr('type') == 'textbox' || input.attr('type') == 'textarea') {
                            if (input.val() == '' || input.val() == null) {
                                $('.common_value_is_' + rowid).val("");
                                $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                                $('#common_error_span_' + rowid).css({
                                    "display": ""
                                });
                                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                e.preventDefault();
                                return false;
                            } else if (!input.val().replace(/\s/g, '').length) {
                                $('.common_value_is_' + rowid).val("");
                                $('#common_error_span_' + rowid).text(labelName + " : " + msg2);
                                $('#common_error_span_' + rowid).css({
                                    "display": ""
                                });
                                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                e.preventDefault();
                                return false;
                            } else if (!input.val().match(/^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/)) {
                                $('.common_value_is_' + rowid).val("");
                                $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
                                $('#common_error_span_' + rowid).css({
                                    "display": ""
                                });
                                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                e.preventDefault();
                                return false;
                            }
                        } else if (input.attr('type') == 'checkbox') {
                            var ids = input.attr('custm_isd');
                            if ($(".required_checkbox_" + ids).is(':checked')) {
                                $('#common_error_span_' + rowid).css({
                                    "display": "none"
                                });
                                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                                $('.required_checkbox_parent_div_' + ids).css({
                                    "color": ""
                                });
                                $('.error_customfield_main_div_' + ids).removeClass('has-error');
                            } else {
                                $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                                $('#common_error_span_' + rowid).css({
                                    "display": ""
                                });
                                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                $('.required_checkbox_' + ids).css({
                                    "outline": "2px solid #a94442"
                                });
                                $('.required_checkbox_parent_div_' + ids).css({
                                    "color": "#a94442"
                                });
                                e.preventDefault();
                                return false;
                            }
                        } else if (input.attr('type') == 'date') {
                            if (input.val() == '' || input.val() == null) {
                                $('.common_value_is_' + rowid).val("");
                                $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                                $('#common_error_span_' + rowid).css({
                                    "display": ""
                                });
                                $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                e.preventDefault();
                                return false;
                            } else {
                                $('#common_error_span_' + rowid).css({
                                    "display": "none"
                                });
                                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                            }
                        }
                    } else if (input.attr('isRequire') == "") {
                        //Nothing to do
                    }
                }
            );
        });


        /*Anykind of input time check for validation for Textbox, Date and Textarea*/
        $('body').on('keyup', '.common_simple_class', function() {

            var rowid = $(this).attr('rows_id');
            var valueIs = $('.common_value_is_' + rowid).val();
            var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
            var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
            var inputTypes = $('.common_value_is_' + rowid).attr('type');

            if (requireOrNot != "") {
                if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
                    if (valueIs == "") {
                        $('.common_value_is_' + rowid).val("");
                        $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                        $('#common_error_span_' + rowid).css({
                            "display": ""
                        });
                        $('.error_customfield_main_div_' + rowid).addClass('has-error');
                    } else if (valueIs.match(/^\s+/)) {
                        $('.common_value_is_' + rowid).val("");
                        $('#common_error_span_' + rowid).text(labelName + " : " + msg4);
                        $('#common_error_span_' + rowid).css({
                            "display": ""
                        });
                        $('.error_customfield_main_div_' + rowid).addClass('has-error');
                    } else if (!valueIs.match(/^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/)) {
                        $('.common_value_is_' + rowid).val("");
                        $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
                        $('#common_error_span_' + rowid).css({
                            "display": ""
                        });
                        $('.error_customfield_main_div_' + rowid).addClass('has-error');
                    } else {
                        $('#common_error_span_' + rowid).css({
                            "display": "none"
                        });
                        $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                    }
                } else if (inputTypes == 'date') {
                    if (valueIs != "") {
                        $('#common_error_span_' + rowid).css({
                            "display": "none"
                        });
                        $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                    } else {
                        $('.common_value_is_' + rowid).val("");
                        $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                        $('#common_error_span_' + rowid).css({
                            "display": ""
                        });
                        $('.error_customfield_main_div_' + rowid).addClass('has-error');
                    }
                } else {
                    //alert("Yes i am radio and checkbox");
                }
            } else {
                if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
                    if (valueIs != "") {
                        if (valueIs.match(/^\s+/)) {
                            $('.common_value_is_' + rowid).val("");
                            $('#common_error_span_' + rowid).text(labelName + " : " + msg4);
                            $('#common_error_span_' + rowid).css({
                                "display": ""
                            });
                            $('.error_customfield_main_div_' + rowid).addClass('has-error');
                        } else if (!valueIs.match(/^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/)) {
                            $('.common_value_is_' + rowid).val("");
                            $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
                            $('#common_error_span_' + rowid).css({
                                "display": ""
                            });
                            $('.error_customfield_main_div_' + rowid).addClass('has-error');
                        } else {
                            $('#common_error_span_' + rowid).css({
                                "display": "none"
                            });
                            $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                        }
                    } else {
                        $('#common_error_span_' + rowid).css({
                            "display": "none"
                        });
                        $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                    }
                }
            }
        });


        /*For required checkbox checked or not*/
        $('body').on('click', '.checkbox_simple_class', function() {

            var rowid = $(this).attr('rows_id');
            var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
            var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
            var inputTypes = $('.common_value_is_' + rowid).attr('type');
            var custId = $('.common_value_is_' + rowid).attr('custm_isd');

            if (requireOrNot != "") {
                if ($(".required_checkbox_" + custId).is(':checked')) {
                    $('.required_checkbox_' + custId).css({
                        "outline": ""
                    });
                    $('.required_checkbox_' + custId).css({
                        "color": ""
                    });
                    $('#common_error_span_' + rowid).css({
                        "display": "none"
                    });
                    $('.required_checkbox_parent_div_' + custId).css({
                        "color": ""
                    });
                    $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                } else {
                    $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                    $('.required_checkbox_' + custId).css({
                        "outline": "2px solid #a94442"
                    });
                    $('.required_checkbox_' + custId).css({
                        "color": "#a94442"
                    });
                    $('#common_error_span_' + rowid).css({
                        "display": ""
                    });
                    $('.required_checkbox_parent_div_' + custId).css({
                        "color": "#a94442"
                    });
                    $('.error_customfield_main_div_' + rowid).addClass('has-error');
                }
            }
        });


        $('body').on('change', '.date_simple_class', function() {

            var rowid = $(this).attr('rows_id');
            var valueIs = $('.common_value_is_' + rowid).val();
            var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
            var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
            var inputTypes = $('.common_value_is_' + rowid).attr('type');
            var custId = $('.common_value_is_' + rowid).attr('custm_isd');

            if (requireOrNot != "") {
                if (valueIs != "") {
                    $('#common_error_span_' + rowid).css({
                        "display": "none"
                    });
                    $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                } else {
                    $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                    $('#common_error_span_' + rowid).css({
                        "display": ""
                    });
                    $('.error_customfield_main_div_' + rowid).addClass('has-error');
                }
            }
        });
    });

</script>


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\InvoiceAddEditFormRequest', '#form_add'); !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

<!-- Form submit at a time only one -->
<script type="text/javascript">
    $(document).ready(function() {

        $('.select_customer').select2();
        $('.select_car').select2();

        $('#customerlist').change(function() {
            var id = $(this).val();
            var url = '{{ route("getData", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url
                , type: 'get'
                , dataType: 'json'
                , success: function(response) {

                    if (response != null) {
                        $('#address').val(response.address);
                        $('#phone').val(response.phone);
                        $('#name').val(response.name);
                        $('#user_id').val(response.id);


                    }
                }
            });
        });


    });

    $(document).ready(function() {
        $('#customerlist').on('change', function() {
            var carID = $(this).val();
            if (carID) {
                $.ajax({
                    url: '/invoice/manual/invoice/car/' + carID
                    , type: "GET"
                    , data: {
                        "_token": "{{ csrf_token() }}"
                    }
                    , dataType: "json"
                    , success: function(data) {
                        console.log(data);
                        if (data) {
                            $('#carlist').empty();
                            $('#carlist').focus;
                            $('#carlist').append('<option value="" disabled selected> Select Car </option>');
                            $.each(data, function(key, value) {
                                $('select[name="carlist"]').append('<option value="' + value.id + '">' + value.manufacturing + '</option>');
                            });
                        } else {
                            $('#carlist').empty();
                        }
                    }
                });
            } else {
                $('#carlist').empty();
            }
        });


        $('#carlist').change(function() {
            var id = $(this).val();
            var url = '{{ route("getCarCustomer", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url
                , type: 'get'
                , dataType: 'json'
                , success: function(response) {

                    if (response != null) {
                        $('#manufacturing').val(response.manufacturing);
                        $('#registration').val(response.registration);
                        $('#manufacturing_date').val(response.manufacturing_date);
                        $('#chassis').val(response.chassis);
                        $('#model').val(response.model);
                        $('#reg_chars').val(response.reg_chars);

                    }
                }
            });
        });
    });

</script>

@endsection
