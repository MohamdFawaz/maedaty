@extends('backend.layouts.default')
@section('content')

    <div class="page-head">
        <div class="page-head-text">
            <h1>{{trans('backend.user.details')}}</h1>
        </div>
    </div>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">

    <div class="row" style="padding-top: 10px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{trans('backend.user.first_name')}}</h3>
                    <p>{{$user->first_name}}</p>
                    <h3>{{trans('backend.user.last_name')}}</h3>
                    <p>{{$user->last_name}}</p>
                    <h3>{{trans('backend.user.phone')}}</h3>
                    <p>{{$user->phone}}</p>
                    <h3>{{trans('backend.user.email')}}</h3>
                    <p>{{$user->email}}</p>
                    <div class="tocify-content friend" >
                        <a href="{{$user->user_image}}" target="_blank" >
                            <h2>{{trans('backend.user.user_image')}}</h2>
                            <img class="image" alt="thumbnail" src="{{$user->user_image}}" style="width: 300px">
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







