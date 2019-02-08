@extends('backend.layouts.default')
@section('content')

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form class="tocify-content" action="{{route('backend.subcategory.store')}}" method="POST" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name_ar">{{trans('backend.subcategory.name_ar')}}</label>
                                <input type="text" name="name_ar" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="name_en">{{trans('backend.subcategory.name_en')}}</label>
                                <input type="text" name="name_en" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label for="name_en">{{trans('backend.subcategory.super_cat_name')}}</label>
                                <select class="form-control" name="category_id">
                                    @foreach($supercategory as $super)
                                        <option value="{{$super->id}}">{{$super->translate()->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <h2>{{trans('backend.subcategory.image')}}</h2>
                            <div class="image-upload friend" >
                                <label for="file-input" class="image-upload-label">
                                    <img src="{{asset('public/images/category/no-category.jpg')}}" class="thumb"/>
                                </label>
                                <input name="category_image" id="file-input" type="file"/>
                            </div>


                            <input type="submit" class="btn btn-success" value="{{trans('backend.action.add')}}">
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
                        <a href="#" class="btn btn-success btn-lg">{{trans('backend.action.yes')}}</a>
                        <button class="btn btn-default btn-lg mb-control-close">{{trans('backend.action.no')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
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







