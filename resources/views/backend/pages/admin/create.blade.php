@extends('backend.layouts.default')
@section('content')

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <form class="tocify-content" action="{{route('backend.admin_users.store')}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="first_name">{{trans('backend.user.first_name')}}</label>
                            <input id="first_name" type="text" name="first_name" class="form-control">
                            <small class="text-danger">{{ $errors->first('first_name') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{trans('backend.user.last_name')}}</label>
                            <input id="last_name" type="text" name="last_name" class="form-control">
                            <small class="text-danger">{{ $errors->first('last_name') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="email">{{trans('backend.user.email')}}</label>
                            <input id="email" type="text" name="email" class="form-control">
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="phone">{{trans('backend.user.phone')}}</label>
                            <input id="phone" type="text" name="phone" class="form-control">
                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="password">{{trans('backend.user.password')}}</label>
                            <input id="password" type="text" name="password" class="form-control">
                            <small class="text-danger">{{ $errors->first('password') }}</small>

                        </div>

                        <h2>{{trans('backend.user.user_image')}}</h2>
                        <div class="image-upload friend" >
                            <label for="file-input" class="image-upload-label">
                                <img alt="upload-user-image" src="{{asset('public/images/profile/no-image.jpg')}}" class="thumb" style="width: 300px"/>
                            </label>
                            <input name="user_image" id="file-input" type="file"/>
                        </div>

                        <input type="submit" class="btn btn-success" value="{{trans('backend.action.create')}}">
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







