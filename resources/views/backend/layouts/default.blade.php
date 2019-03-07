<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    @include('backend.includes.head')
</head>
<body>
<div class="page-container">
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <li class="xn-logo">
                <a href="{{route('backend.dashboard')}}">{{trans('backend.title')}}</a>
                <a href="#" class="x-navigation-control"></a>
            </li>
            <li class="xn-profile">
                <a href="#" class="profile-mini">
                    <img src="{{ Auth()->user()->user_image }}" alt="admin"/>
                </a>
                <div class="profile">
                    <div class="profile-image">
                        <img src="{{ Auth()->user()->user_image }}" alt="admin"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name">{{Auth()->user()->first_name}} {{Auth()->user()->last_name}}</div>
                        <div class="profile-data-title">{{Auth()->user()->email}}</div>
                    </div>

                </div>
            </li>
            <li class="xn-title">{{trans('backend.sidemenu.navigation')}}</li>
            <li class="@if(url()->current() == route('backend.dashboard')) active @endif" >
                <a href="{{route('backend.dashboard')}}"><span class="fa fa-desktop"></span> <span class="xn-text">{{trans('backend.sidemenu.dashboard')}}</span></a>
            </li>
            @role('Super Admin')
                @include('backend.includes.superadmin')
            @elseif('Store Admin')
                @include('backend.includes.storeadmin')
            @endrole
        </ul>
        <!-- END X-NAVIGATION -->
    </div>
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>  <strong>{{trans('backend.question.are_you_sure_logout')}}</strong></div>
                <div class="mb-content">
                    <p></p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a href="{{route('backend.logout')}}" class="btn btn-success btn-lg">{{trans('backend.action.yes')}}</a>
                        <button class="btn btn-default btn-lg mb-control-close">{{trans('backend.action.no')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('message-box')
<div class="page-content">
    @include('backend.includes.header')

    <div class="row" style="padding: 10px;">
        @yield('content')
    </div>
</div>

    <footer class="row">
        @include('backend.includes.footer')
    </footer>


</div>
</body>
</html>
