@extends('backend.layouts.default')
@section('content')

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

    <div class="row" style="padding-top: 10px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{trans('backend.products.name_ar')}}</h3>
                    <p>{{$product->translate('ar')->name}}</p>
                    <h3>{{trans('backend.products.name_en')}}</h3>
                    <p>{{$product->translate('en')->name}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="tocify-content">
                        <a href="{{$product->product_image}}" target="_blank" class="friend">
                            <h2>{{trans('backend.products.image')}}</h2>
                            <img class="image" alt="product_image" src="{{$product->product_image}}" style="width: 300px">
                        </a>
                        <div class="friend">
                            <div class="status-online">{!! $product->status_label !!} </div>
                        </div>
                        <h2>{{trans('backend.products.description_ar')}}</h2>
                        <p>{{$product->translate('ar')->description}}</p>

                        <h2>{{trans('backend.products.description_en')}}</h2>
                        <p>{{$product->translate('en')->description}}</p>

                        <h2>{{trans('backend.products.shop')}}</h2>
                        <p>{{$product->shop->translate('en')->name}}</p>

                        <h2>{{trans('backend.products.price')}}</h2>
                        @if($product->hot_offer)
                        <span style="text-decoration: line-through">{{$product->price}} {{config('settings.currency_symbol')}}</span>
                        <span class="text-danger">{{$product->hot_offer->discounted_price}} {{config('settings.currency_symbol')}}</span>
                        @else
                        <span>{{$product->price}} {{config('settings.currency_symbol')}}</span>
                        @endif

                        <h2>{{trans('backend.products.product_stock')}}</h2>
                        <p>{{$product->product_stock}}</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="position: relative;">
            <div id="tocify"></div>
        </div>
    </div>



</div>
    <!-- END PAGE CONTENT WRAPPER -->
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
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







