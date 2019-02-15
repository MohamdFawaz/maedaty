@extends('backend.layouts.default')
@section('content')

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form class="tocify-content" action="{{route('backend.shop.store')}}" method="POST" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name_ar">{{trans('backend.shop.name_ar')}}</label>
                                <input id="name_ar" type="text" name="name_ar" class="form-control" >
                                <small class="text-danger">{{ $errors->first('name_ar') }}</small>

                            </div>

                            <div class="form-group">
                                <label for="description_ar">{{trans('backend.shop.description_ar')}}</label>
                                <textarea id="description_ar" name="description_ar" class="form-control"></textarea>
                                <small class="text-danger">{{ $errors->first('description_ar') }}</small>

                            </div>

                            <div class="form-group">
                                <label for="name_en">{{trans('backend.shop.name_en')}}</label>
                                <input type="text" name="name_en" class="form-control">
                                <small class="text-danger">{{ $errors->first('name_en') }}</small>

                            </div>

                            <div class="form-group">
                                <label for="description_en">{{trans('backend.shop.description_en')}}</label>
                                <textarea id="description_en" name="description_en" class="form-control"></textarea>
                                <small class="text-danger">{{ $errors->first('description_en') }}</small>

                            </div>


                            <div class="form-group">
                                <label for="owner">{{trans('backend.shop.owner_name')}}</label>
                                <select class="form-control" name="owner_id" id="owner">
                                    <option value="">{{trans('messages.choose_option')}}</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->full_name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('owner_id') }}</small>

                            </div>

                            <h2>{{trans('backend.shop.image')}}</h2>
                            <div class="image-upload friend" >
                                <label for="file-input" class="image-upload-label">
                                    <img src="{{asset('public/images/shop/no-image.jpg')}}" class="thumb"/>
                                </label>
                                <input name="shop_image" id="file-input" type="file"/>
                                <small class="text-danger">{{ $errors->first('shop_image') }}</small>

                            </div>

                            <input type="submit" class="btn btn-success" value="{{trans('backend.action.edit')}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- END PAGE CONTENT WRAPPER -->

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







