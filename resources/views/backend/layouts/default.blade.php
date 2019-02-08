<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    @include('backend.includes.head')
</head>
<body>
@include('backend.includes.header')
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
            <li class="@if(Request::segment(2) == 'products') active @endif" >
                <a href="{{route('backend.products')}}"><span class="fa fa-shopping-cart"></span> <span class="xn-text">{{trans('backend.sidemenu.products')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'category') active @endif" >
                <a href="{{route('backend.category')}}"><span class="fa fa-bars"></span> <span class="xn-text">{{trans('backend.sidemenu.category')}}</span></a>
            </li>
            <li class="@if(Request::segment(2) == 'subcategory') active @endif" >
                <a href="{{route('backend.subcategory')}}"><span class="fa fa-bars"></span> <span class="xn-text">{{trans('backend.sidemenu.subcategory')}}</span></a>
            </li>
            <li class="xn-openable hidden">
                <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Pages</span></a>
                <ul>
                    <li><a href="pages-gallery.html"><span class="fa fa-image"></span> Gallery</a></li>
                    <li><a href="pages-invoice.html"><span class="fa fa-dollar"></span> Invoice</a></li>
                    <li><a href="pages-edit-profile.html"><span class="fa fa-wrench"></span> Edit Profile</a></li>
                    <li><a href="pages-profile.html"><span class="fa fa-user"></span> Profile</a></li>
                    <li><a href="pages-address-book.html"><span class="fa fa-users"></span> Address Book</a></li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-clock-o"></span> Timeline</a>
                        <ul>
                            <li><a href="pages-timeline.html"><span class="fa fa-align-center"></span> Default</a></li>
                            <li><a href="pages-timeline-simple.html"><span class="fa fa-align-justify"></span> Full Width</a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-envelope"></span> Mailbox</a>
                        <ul>
                            <li><a href="pages-mailbox-inbox.html"><span class="fa fa-inbox"></span> Inbox</a></li>
                            <li><a href="pages-mailbox-message.html"><span class="fa fa-file-text"></span> Message</a></li>
                            <li><a href="pages-mailbox-compose.html"><span class="fa fa-pencil"></span> Compose</a></li>
                        </ul>
                    </li>
                    <li><a href="pages-messages.html"><span class="fa fa-comments"></span> Messages</a></li>
                    <li><a href="pages-calendar.html"><span class="fa fa-calendar"></span> Calendar</a></li>
                    <li><a href="pages-tasks.html"><span class="fa fa-edit"></span> Tasks</a></li>
                    <li><a href="pages-content-table.html"><span class="fa fa-columns"></span> Content Table</a></li>
                    <li><a href="pages-faq.html"><span class="fa fa-question-circle"></span> FAQ</a></li>
                    <li><a href="pages-search.html"><span class="fa fa-search"></span> Search</a></li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file"></span> Blog</a>

                        <ul>
                            <li><a href="pages-blog-list.html"><span class="fa fa-copy"></span> List of Posts</a></li>
                            <li><a href="pages-blog-post.html"><span class="fa fa-file-o"></span>Single Post</a></li>
                        </ul>
                    </li>
                    <li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-sign-in"></span> Login</a>
                        <ul>
                            <li><a href="pages-login.html">Login v1</a></li>
                            <li><a href="pages-login-v2.html">Login v2</a></li>
                            <li><a href="pages-login-inside.html">Login v2 Inside</a></li>
                            <li><a href="pages-login-website.html">Website Login</a></li>
                            <li><a href="pages-login-website-light.html"> Website Login Light</a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-plus"></span> Registration</a><div class="informer informer-danger">New!</div>
                        <ul>
                            <li><a href="pages-registration.html">Default</a></li>
                            <li><a href="pages-registration-login.html">With Login</a></li>
                        </ul>
                    </li>
                    <li><a href="pages-forgot-password.html"><span class="fa fa-question"></span> Forgot Password</a><div class="informer informer-danger">New!</div></li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-warning"></span> Error Pages</a>
                        <ul>
                            <li><a href="pages-error-404.html">Error 404 Sample 1</a></li>
                            <li><a href="pages-error-404-2.html">Error 404 Sample 2</a></li>
                            <li><a href="pages-error-500.html"> Error 500</a></li>
                        </ul>
                    </li>
                </ul>
            </li>


        </ul>
        <!-- END X-NAVIGATION -->
    </div>
    <div class="message-box message-box-danger animated fadeIn" data-sound="alert" id="mb-signout">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>  <strong>{{trans('backend.action.delete')}}</strong> ?</div>
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
<div class="page-content">

    <div class="row">
        @yield('content')
    </div>
</div>

    <footer class="row">
        @include('backend.includes.footer')
    </footer>


</div>
</body>
</html>
