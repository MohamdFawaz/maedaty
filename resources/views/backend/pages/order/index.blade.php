@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.order.list')}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="products-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.order.id')}}</th>
                                    <th>{{trans('backend.order.order_number')}}</th>
                                    <th>{{trans('backend.order.username')}}</th>
                                    <th>{{trans('backend.order.total_fees')}}</th>
                                    <th>{{trans('backend.order.order_date')}}</th>
                                    <th>{{trans('backend.order.status')}}</th>
                                    <th>{{trans('backend.order.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->order_number}}</td>
                                    <td>{{$order->user->first_name." ".$order->user->last_name}}</td>
                                    <td>{{ $order->total_fees }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{!!  $order->order_status_label !!}</td>
                                    <td>{!! $order->action !!}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END DEFAULT DATATABLE -->



            </div>
        </div>

    </div>
    <!-- PAGE CONTENT WRAPPER -->

@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function() {
            $('#products-table').dataTable( {
                "lengthMenu": [5, 7, 10],
                "pageLength": 5
            } );

        } );
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    {{--<script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}
    <!-- END PAGE PLUGINS -->

@endsection







