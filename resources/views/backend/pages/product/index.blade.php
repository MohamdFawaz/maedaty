    @extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.products.list')}}</h3>
                        <ul class="panel-controls">
                            <a href="{{route('backend.products.create')}}" >
                                <span class="btn btn-success">{{trans('backend.action.create')}}</span>
                            </a>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="products-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.products.id')}}</th>
                                    <th>{{trans('backend.products.name_ar')}}</th>
                                    <th>{{trans('backend.products.name_en')}}</th>
                                    <th>{{trans('backend.products.shop')}}</th>
                                    <th>{{trans('backend.products.price')}}</th>
                                    <th>{{trans('backend.products.image')}}</th>
                                    <th>{{trans('backend.products.product_stock')}}</th>
                                    <th>{{trans('backend.products.status')}}</th>
                                    <th>{{trans('backend.products.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->translate('ar')['name']}}</td>
                                    <td>{{$product->translate('en')['name']}}</td>
                                    <td>{{$product->shop->translate('en')['name']}}</td>
                                    <td>{{$product->price}} {{config('settings.currency_symbol')}}</td>
                                    <td><img src="{{$product->product_image}}" width="100"></td>
                                    <td width="1px">{{$product->product_stock}}</td>
                                    <td>{!! $product->status_label !!}</td>
                                    <td>{!! $product->action !!}</td>
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
    <div class="message-box message-box-danger animated fadeIn" id="mb-delete-product">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>{{trans('backend.action.delete')}} <strong id="product-name"></strong> ?</div>
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
        $(".delete-product-btn").click(function(){
            var product_id = $(this).data('id');
            var product_name = $(this).data('name');
            $('#product-name').text(product_name);
            var url  = '{{route("backend.product.delete",":id")}}';
            url = url.replace(':id',product_id);
            $("#delete-ref").attr("href",url);
            $('#mb-delete-product').addClass('open');
        });
        $(document).ready(function() {
            $('.datatable').dataTable( {
                "lengthMenu": [5, 7, 10],
                "pageLength": 5
            } );
        } );
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







