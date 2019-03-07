<li class="@if(Request::segment(2) == 'products') active @endif" >
    <a href="{{route('backend.products')}}"><span class="fa fa-shopping-cart"></span> <span class="xn-text">{{trans('backend.sidemenu.products')}}</span></a>
</li>
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
<li class="@if(Request::segment(2) == 'promo') active @endif" >
    <a href="{{route('backend.promo')}}"><span class="fa fa-tag"></span> <span class="xn-text">{{trans('backend.sidemenu.promo')}}</span></a>
</li>