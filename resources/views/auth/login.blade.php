<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>{{trans('backend.title')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{asset('public/images/maedaty-logo.jpg')}}" type="image/x-icon" />

    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('public/css/theme-night.css')}}"/>
</head>
<body>

<div class="login-container">

    <div class="login-box animated fadeInDown">

        <div class="login-title">
            <img src="{{asset('public/images/icon/grand-white-hori-logo.png')}}" alt="grand-logo" style="max-width: 390px">
        </div>
        <div class="login-body">
            <div class="login-title"><strong>Welcome</strong>, Please login</div>
            <form role="form" method="POST" action='{{url()->current()}}' class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" placeholder="{{trans('backend.auth.email_placeholder')}}" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" placeholder="{{trans('backend.auth.password_placeholder')}}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{--<div class="form-group">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<label for="role_id">{{trans('backend.auth.role')}}</label>--}}
                        {{--<select id="role_id" type="role_id" class="form-control" name="role_id">--}}
                            {{--<option value="" >{{trans('messages.choose_option')}}</option>--}}
                            {{--@foreach($roles as $role)--}}
                                {{--<option class="form-control" value="{{$role->id}}" >{{$role->title}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block">Log In</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <div class="pull-left">
                &copy; 2018 Maedaty
            </div>
            <div class="pull-right">
                <a href="{{trans('backend.footer.grand_website')}}">{{trans('backend.footer.developed_by_grand')}}</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
