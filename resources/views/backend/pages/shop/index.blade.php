@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.shop.list')}}</h3>
                        <ul class="panel-controls">
                            <a href="{{route('backend.shop.create')}}" >
                                <span class="btn btn-success">{{trans('backend.action.create')}}</span>
                            </a>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="shops-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.shop.id')}}</th>
                                    <th>{{trans('backend.shop.name_ar')}}</th>
                                    <th>{{trans('backend.shop.name_en')}}</th>
                                    <th>{{trans('backend.shop.owner_name')}}</th>
                                    <th>{{trans('backend.shop.image')}}</th>
                                    <th>{{trans('backend.shop.status')}}</th>
                                    <th>{{trans('backend.shop.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shops as $shop)
                                <tr>
                                    <td>{{$shop->id}}</td>
                                    <td>{{$shop->translate('ar')['name']}}</td>
                                    <td>{{$shop->translate('en')['name']}}</td>
                                    <td>{{$shop->user->full_name}}</td>
                                    <td><img src="{{$shop->image}}" alt="shop-image" style="width: 30%;"></td>
                                    <td>{!! $shop->status_label !!}</td>
                                    <td>{!! $shop->action !!}</td>
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
    <!-- MESSAGE BOX-->
    <div class="message-box message-box-danger animated fadeIn" id="mb-delete-shop">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>{{trans('backend.action.delete')}} <strong id="shop-name"></strong> ?</div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a id="delete-ref" class="btn btn-success btn-lg">Yes</a>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MESSAGE BOX-->
@endsection
@section('script')
    <script type="text/javascript">
        $(".delete-shop-btn").click(function(){
            var shop_id = $(this).data('id');
            var shop_name = $(this).data('name');
            $('#shop-name').text(shop_name);
            var url  = '{{route("backend.shop.delete",":id")}}';
            url = url.replace(':id',shop_id);
            $("#delete-ref").attr("href",url);
            $('#mb-delete-shop').addClass('open');
        });
        $(document).ready(function() {
            $('.datatable').dataTable( {
                "lengthMenu": [5, 7, 10],
                "pageLength": 5
            } );
        } );
        $(".status").change(function(){
            var shop_id=$(this).attr('id');
            var status_val=$(this).attr('value');
            if(status_val==0)
            {
                status_val=1;
                $('#'+shop_id).val("1");
            }else{
                status_val=0;
                $('#'+shop_id).val("0");
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{route('backend.shop.update.status')}}',
                {shop_id,status:status_val},
                function(data){
                    if(data.success){
                        var label = $("#label-"+shop_id);
                        if(data.status == 1){
                            label.toggleClass('label-danger label-success');
                            label.html('{{trans('backend.products.active')}}');
                        }else{
                            label.toggleClass('label-danger label-success');
                            label.html('{{trans('backend.products.not_active')}}');
                        }
                    }
                });
        });
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







