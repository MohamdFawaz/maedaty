<li class="@if(Request::segment(2) == 'products') active @endif" >
    <a href="{{route('backend.products')}}"><span class="fa fa-shopping-cart"></span> <span class="xn-text">{{trans('backend.sidemenu.products')}}</span></a>
</li>
<li class="@if(Request::segment(2) == 'review') active @endif" >
    <a href="{{route('backend.review')}}"><span class="fa fa-comment"></span> <span class="xn-text">{{trans('backend.sidemenu.reviews')}}</span></a>
</li>
<li class="@if(Request::segment(2) == 'shop_branch') active @endif" >
    <a href="{{route('backend.shop_branch')}}"><span class="fa fa-building-o"></span> <span class="xn-text">{{trans('backend.sidemenu.shop_branch')}}</span></a>
</li>
<li class="@if(Request::segment(2) == 'admin_users') active @endif" >
    <a href="{{route('backend.admin_users')}}"><span class="fa fa-user-md"></span> <span class="xn-text">{{trans('backend.sidemenu.admin_users')}}</span></a>
</li>