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
                    <h3>{{trans('backend.shop.name_en')}}</h3>
                    <p>{{$shop->translate('en')->name}}</p>
                    <div class="tocify-content">
                        <a href="{{$shop->img}}" target="_blank" class="friend" >
                            <h2>{{trans('backend.shop.image')}}</h2>
                            <img class="image thumbnail friend"  alt="thumbnail" src="{{$shop->image}}" style="width: 50%">
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







