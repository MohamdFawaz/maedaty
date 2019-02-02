@extends('backend.layouts.default')
@section('content')

    <div class="page-head">
        <div class="page-head-text">
            <h1>{{trans('backend.products.details')}}</h1>
        </div>
        <div class="page-head-controls">
            <a  href="{{route('backend.products.edit',$product->id)}}" class="btn btn-success btn-rounded"><span class="fa fa-pencil"></span>{{trans('backend.action.edit')}}</a>
            <a  href="#" data-box="#mb-delete-product " class="mb-control btn btn-danger btn-rounded"><span class="fa fa-times"></span>{{trans('backend.action.delete')}}</a>
        </div>
    </div>
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
                        <a href="{{$product->product_image}}" target="_blank" class="friend" >
                            <h2>{{trans('backend.products.image')}}</h2>
                            <img class="image" alt="thumbnail" src="{{$product->product_image}}" style="width: 300px">
                        </a>
                        <div class="profile-data-name">
                            <div class="profile-data-name" >{!! $product->status_label !!} </div>
                        </div>
                        <h2>{{trans('backend.products.description_ar')}}</h2>
                        <p>{{$product->translate('ar')->description}}</p>

                        <h2>{{trans('backend.products.description_en')}}</h2>
                        <p>{{$product->translate('en')->description}}</p>

                        <h2>{{trans('backend.products.shop')}}</h2>
                        <p>{{$product->shop->translate('en')->name}}</p>

                        <h2>{{trans('backend.products.category')}}</h2>
                        <p>{{$product->category->translate('en')->name}}</p>

                        @if($product->subcategory)
                        <h2>{{trans('backend.products.subcategory')}}</h2>
                        <p>{{$product->subcategory->translate('en')->name}}</p>
                        @endif

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
      @if($images)
        <div class="row col-md-12">
            <h2>{{trans('backend.products.images')}}</h2>
        @foreach($images as $image)
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body panel-body-image">
                        <a href="{{$image->image_name}}" target="_blank" >
                            <img src="{{$image->image_name}}" alt="product-image-{{$image->id}}" width="30%">
                        </a>
                    </div>
                    <div class="panel-footer text-muted">

                    </div>
                </div>
            </div>
            @endforeach
        </div>
      @endif


</div>
    <!-- END PAGE CONTENT WRAPPER -->
    <!-- MESSAGE BOX-->
    <div class="message-box message-box-danger animated fadeIn" data-sound="alert" id="mb-delete-product">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>  <strong>{{trans('backend.action.delete')}}</strong> ?</div>
                <div class="mb-content">
                    <p>{{trans('backend.question.are_you_sure_delete')}}</p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <form action="{{ route('backend.products.destroy',$product->id) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button  class="btn btn-success btn-lg">{{trans('backend.action.yes')}}</button>
                            <button class="btn btn-default btn-lg mb-control-close">{{trans('backend.action.no')}}</button>

                        </form>
                        {{--<a href="{{route('backend.products.destroy',$product->id)}}" class="btn btn-success btn-lg">{{trans('backend.action.yes')}}</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
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







