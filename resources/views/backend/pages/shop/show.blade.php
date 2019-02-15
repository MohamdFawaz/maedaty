@extends('backend.layouts.default')
@section('content')

    <div class="page-head">
        <div class="page-head-text">
            <h1>{{trans('backend.shop.details')}}</h1>
        </div>
        <div class="page-head-controls">
            <a  href="{{route('backend.shop.edit',$shop->id)}}" class="btn btn-success btn-rounded"><span class="fa fa-pencil"></span>{{trans('backend.action.edit')}}</a>
        </div>
    </div>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">

    <div class="row" style="padding-top: 10px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{trans('backend.shop.name_ar')}}</h3>
                    <p>{{$shop->translate('ar')->name}}</p>

                    <h3>{{trans('backend.shop.description_ar')}}</h3>
                    <p>{{$shop->translate('ar')->description}}</p>

                    <h3>{{trans('backend.shop.name_en')}}</h3>
                    <p>{{$shop->translate('en')->name}}</p>

                    <h3>{{trans('backend.shop.description_en')}}</h3>
                    <p>{{$shop->translate('en')->description}}</p>

                    <h3>{{trans('backend.shop.owner_name')}}</h3>
                    <p>{{$shop->user->full_name}}</p>

                    <div class="tocify-content">
                        <a href="{{$shop->img}}" target="_blank" class="" >
                            <h2>{{trans('backend.shop.image')}}</h2>
                            <img class="thumbnail"  alt="shop-thumbnail" src="{{$shop->image}}" style="width: 50%">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <!-- END PAGE CONTENT WRAPPER -->

@endsection
@section('script')
    <script type="text/javascript">
        
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







