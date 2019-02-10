@extends('backend.layouts.default')
@section('content')

    <div class="page-head">
        <div class="page-head-text">
            <h1>{{trans('backend.order.details')}}</h1>
        </div>
        <div class="page-head-controls">
            <button class="btn btn-success btn-rounded" data-toggle="modal" data-target="#edit-order"><span class="fa fa-pencil"></span>{{trans('backend.action.edit')}}</button>
        </div>
        <!-- Button trigger modal -->
        {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
            {{--Launch demo modal--}}
        {{--</button>--}}
    </div>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="panel panel-default" style="padding: 20px" id="print_area">
        <div class="panel-body">
            <h2>{{trans('backend.order.order_number')}} <strong>#{{$order->order_number}}</strong></h2>
            <h2>{{trans('backend.order.order_status')}} <strong>{!! $order->order_status_label !!}</strong></h2>

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
    <div class="modal fade" id="edit-order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('backend.order.update_order')}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
                <form action="{{route('backend.change.order.address')}}" method="post">
                <div class="modal-body">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{$order->id}}" name="order_id" />
                        {{method_field('post')}}

                        <div class="form-group">
                            <label for="order_status">{{trans('backend.action.change_order_status')}}</label>
                            <select name="order_status" id="order_status" class="form-control" >
                                <option value="">{{trans('messages.choose_option')}}</option>
                            @foreach($order_status as $status)
                                <option value="{{$status->id}}" @if($order->order_status == $status->id) selected @endif>{{$status->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="shipping_fees">{{trans('backend.order.shipping')}}</label>
                            <input name="shipping_fees" id="shipping_fees" class="form-control" @if($order->shipping_fees && $order->order_status == 2 || $order->order_status == 3)  value="{{$order->shipping_fees}}" readonly @endif/>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('backend.action.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('backend.action.submit')}}</button>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

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







