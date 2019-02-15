@extends('backend.layouts.default')
@section('content')

    <div class="page-head">
        <div class="page-head-text">
            <h1>{{trans('backend.subcategory.details')}}</h1>
        </div>
        <div class="page-head-controls">
            <a  href="{{route('backend.subcategory.edit',$category->id)}}" class="btn btn-success btn-rounded"><span class="fa fa-pencil"></span>{{trans('backend.action.edit')}}</a>
            <a  href="#" data-box="#mb-delete-product " class="mb-control btn btn-danger btn-rounded"><span class="fa fa-times"></span>{{trans('backend.action.delete')}}</a>
        </div>
    </div>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">

    <div class="row" style="padding-top: 10px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{trans('backend.subcategory.name_ar')}}</h3>
                    <p>{{$category->translate('ar')->name}}</p>
                    <h3>{{trans('backend.subcategory.name_en')}}</h3>
                    <p>{{$category->translate('en')->name}}</p>
                    @if($category->get_category($category->category_id))
                    <h3>{{trans('backend.subcategory.super_cat_name')}}</h3>
                    <p>{{$category->get_category($category->category_id)->translate()->name}}</p>
                    @endif
                    <div class="tocify-content">
                        <a href="{{$category->category_image}}" target="_blank" >
                            <h2>{{trans('backend.category.image')}}</h2>
                            <img class="image thumbnail" alt="thumbnail" src="{{$category->category_image}}" style="width: 300px">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <form action="{{ route('backend.subcategory.destroy',$category->id) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button  class="btn btn-success btn-lg">{{trans('backend.action.yes')}}</button>
                            <button class="btn btn-default btn-lg mb-control-close">{{trans('backend.action.no')}}</button>

                        </form>
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







