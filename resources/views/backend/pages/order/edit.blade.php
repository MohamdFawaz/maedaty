@extends('backend.layouts.default')
@section('content')

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <form class="tocify-content" action="{{route('backend.subcategory.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name_ar">{{trans('backend.subcategory.name_ar')}}</label>
                            <input type="text" name="name_ar" class="form-control" value="{{$category->translate('ar')->name}}">
                        </div>
                        <div class="form-group">
                            <label for="name_en">{{trans('backend.subcategory.name_en')}}</label>
                            <input type="text" name="name_en" class="form-control" value="{{$category->translate('en')->name}}">
                        </div>

                        <div class="form-group">
                            <label for="name_en">{{trans('backend.subcategory.super_cat_name')}}</label>
                                <select class="form-control" name="category_id">
                                @foreach($supercategory as $super)
                                <option value="{{$super->id}}" @if($super->id == $category->category_id) selected @endif>{{$super->translate()->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <h2>{{trans('backend.subcategory.image')}}</h2>
                        <div class="image-upload friend" >
                            <label for="file-input" class="image-upload-label">
                                <img src="{{$category->category_image}}" class="thumb" style="width: 300px"/>
                            </label>
                            <input name="category_image" id="file-input" type="file"/>
                        </div>

                        <input type="submit" class="btn btn-success" value="{{trans('backend.action.edit')}}">
                        </form>
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
                        <a href="{{route('backend.products.destroy',$category->id)}}" class="btn btn-success btn-lg">{{trans('backend.action.yes')}}</a>
                        <button class="btn btn-default btn-lg mb-control-close">{{trans('backend.action.no')}}</button>
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
        // $(".image-upload-label").click(function(){
        //     $(".image-upload-label").addClass("hidden");
        // });
        $("#has_offer").change(function(){
            if(this.checked){
                $(".discount-box").removeClass("hidden");
            }else{
                $(".discount-box").addClass("hidden");
            }
        });
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.thumb').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file-input").change(function() {
            readURL(this);
        });
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







