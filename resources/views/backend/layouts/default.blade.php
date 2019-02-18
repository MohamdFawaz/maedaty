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
            <li class="xn-title">Navigation</li>
            <li class="@if(url()->current() == route('backend.dashboard')) active @endif" >
                <a href="{{route('backend.dashboard')}}"><span class="fa fa-desktop"></span> <span class="xn-text">{{trans('backend.sidemenu.dashboard')}}</span></a>
            </li>
            @can('show products')
            <li class="@if(Request::segment(2) == 'products') active @endif" >
                <a href="{{route('backend.products')}}"><span class="fa fa-shopping-cart"></span> <span class="xn-text">{{trans('backend.sidemenu.products')}}</span></a>
            </li>
            @endcan

            <li class="@if(Request::segment(2) == 'category') active @endif" >
                <a href="{{route('backend.category')}}"><span class="fa fa-bars"></span> <span class="xn-text">{{trans('backend.sidemenu.category')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'subcategory') active @endif" >
                <a href="{{route('backend.subcategory')}}"><span class="fa fa-bars"></span> <span class="xn-text">{{trans('backend.sidemenu.subcategory')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'order') active @endif" >
                <a href="{{route('backend.order')}}"><span class="fa fa-files-o"></span> <span class="xn-text">{{trans('backend.sidemenu.order')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'user') active @endif" >
                <a href="{{route('backend.user')}}"><span class="fa fa-users"></span> <span class="xn-text">{{trans('backend.sidemenu.user')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'review') active @endif" >
                <a href="{{route('backend.review')}}"><span class="fa fa-comment"></span> <span class="xn-text">{{trans('backend.sidemenu.reviews')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'message') active @endif" >
                <a href="{{route('backend.message')}}"><span class="fa fa-comments"></span> <span class="xn-text">{{trans('backend.sidemenu.messages')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'suggestion') active @endif" >
                <a href="{{route('backend.suggestion')}}"><span class="fa fa-comments-o"></span> <span class="xn-text">{{trans('backend.sidemenu.suggestion')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'shop') active @endif" >
                <a href="{{route('backend.shop')}}"><span class="fa fa-home"></span> <span class="xn-text">{{trans('backend.sidemenu.shop')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'shop_branch') active @endif" >
                <a href="{{route('backend.shop_branch')}}"><span class="fa fa-building-o"></span> <span class="xn-text">{{trans('backend.sidemenu.shop_branch')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'settings') active @endif" >
                <a href="{{route('backend.settings.edit',1)}}"><span class="fa fa-cog"></span> <span class="xn-text">{{trans('backend.sidemenu.setting')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'admin_users') active @endif" >
                <a href="{{route('backend.admin_users')}}"><span class="fa fa-user-md"></span> <span class="xn-text">{{trans('backend.sidemenu.admin_users')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'notification') active @endif" >
                <a href="{{route('backend.notification')}}"><span class="fa fa-bell-o"></span> <span class="xn-text">{{trans('backend.sidemenu.notification')}}</span></a>
            </li>
        </ul>
        <!-- END X-NAVIGATION -->
    </div>
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>  <strong>{{trans('backend.question.are_you_sure_logout')}}</strong> ?</div>
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
