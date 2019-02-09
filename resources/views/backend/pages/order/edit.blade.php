@extends('backend.layouts.default')
@section('content')

    <div class="page-head">
        <div class="page-head-text">
            <h1>{{trans('backend.order.details')}}</h1>
        </div>
    </div>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="panel panel-default" style="padding: 20px" id="print_area">
        <div class="panel-body">
            <h2>{{trans('backend.order.order_number')}} <strong>#{{$order->order_number}}</strong></h2>
            <div class="push-down-10 pull-right">
                <button class="btn btn-default" id="print"><span class="fa fa-print"></span> Print</button>
            </div>
            <!-- INVOICE -->
            <div class="invoice">

                <div class="row">
                    <div class="col-md-4">

                        <div class="invoice-address">
                            <h5>{{trans('backend.order.user_info')}}</h5>
                            <h6>{{$order->user->full_name}}</h6>
                            <p>{{$order->user->phone}}</p>
                            <p>{{$order->user->email}}</p>
                        </div>

                    </div>
                    <div class="col-md-4">

                        <div class="invoice-address">
                            <h5>{{trans('backend.order.address_info')}}</h5>
                            <h6>{{$order->address->full_name}}</h6>
                            <p>{{$order->address->phone}}</p>
                            <p>{{$order->address->address}}</p>
                            <p><a href="{{$order->address->google_location}}" target="_blank">{{trans('backend.order.location_on_map')}}</a></p>

                        </div>

                    </div>
                    <div class="col-md-4">

                        <div class="invoice-address">
                            <h5>Invoice</h5>
                            <table class="table table-striped">
                                <tbody><tr>
                                    <td width="200">{{trans('backend.order.order_number')}}:</td><td class="text-right">#{{$order->order_number}}</td>
                                </tr>
                                <tr>
                                    <td>{{trans('backend.order.order_date')}}:</td><td class="text-right">{{$order->order_date}}</td>
                                </tr>
                                <tr>
                                    <td>{{trans('backend.order.order_time')}}:</td><td class="text-right">{{$order->order_time}}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{trans('backend.order.total_fees')}}:</strong></td><td class="text-right"><strong>{{$order->total_fees}}</strong></td>
                                </tr>
                                </tbody></table>

                        </div>

                    </div>
                </div>

                <div class="table-invoice">
                    <table class="table">
                        <tbody><tr>
                            <th>{{trans('backend.order.order_products')}}</th>
                            <th class="text-center">{{trans('backend.order.purchase_price')}}</th>
                            <th class="text-center">{{trans('backend.order.qty')}}</th>
                            <th class="text-center">{{trans('backend.order.item_total')}}</th>
                        </tr>
                        @foreach($order_products as $order_product)
                            <tr>
                                <td>
                                    <strong>{{$order_product['product']['name']}}</strong>
                                    <p>{{$order_product['product']['description']}}</p>
                                </td>
                                <td class="text-center">{{$order_product['purchase_price']}}</td>
                                <td class="text-center">{{$order_product['qty']}}</td>
                                <td class="text-center">{{$order_product['product_total']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h4>{{trans('backend.order.payment_method')}}</h4>

                        <div class="paymant-table">
                            <a href="#" class="@if($order->payment_method == 1) active @endif" data-ytta-id="-">
                                {{trans('backend.order.cod')}}
                            </a>
                            <a href="#" class="@if($order->payment_method == 2) active @endif" data-ytta-id="-">
                                {{trans('backend.order.online_pay')}}
                            </a>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <h4>Amount Due</h4>

                        <table class="table table-striped">
                            <tbody><tr>
                                <td width="200"><strong>{{trans('backend.order.subtotal')}}:</strong></td><td class="text-right">{{$order->subtotal_fees}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{trans('backend.order.shipping')}}:</strong></td><td class="text-right">{{$order->shipping_fees}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{trans('backend.order.used_promo')}}</strong></td><td class="text-right">{!! $order->used_promo_label !!}</td>
                            </tr>
                            <tr>
                                <td><strong>{{trans('backend.order.used_points')}}</strong></td><td class="text-right">{!! $order->used_points_label !!}</td>
                            </tr>
                            <tr class="total">
                                <td>{{trans('backend.order.total_fees')}}</td><td class="text-right">{{$order->total_fees  }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <!-- END INVOICE -->

        </div>
    </div>    <!-- END PAGE CONTENT WRAPPER -->
    <!-- MESSAGE BOX-->

@endsection
@section('script')
    <script type="text/javascript">
        $(".status").change(function(){
            var product_id=$(this).attr('id');
            var status_val=$(this).attr('value');
            if(status_val==0)
            {
                status_val=1;
                $('#'+product_id).val("1");
            }else{
                status_val=0;
                $('#'+product_id).val("0");
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{url()->current()."/updateStatus"}}',
                {product_id:product_id,status:status_val},
                function(data){
                    if(data.success){
                        if(data.status == 1){
                            $("#label-"+product_id).toggleClass('label-danger label-success');
                            $("#label-"+product_id).html('{{trans('backend.products.active')}}');
                        }else{
                            $("#label-"+product_id).toggleClass('label-danger label-success');
                            $("#label-"+product_id).html('{{trans('backend.products.not_active')}}');
                        }
                    }
                });
        });
        $('#print').click(function(){
            window.print();
        });
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







