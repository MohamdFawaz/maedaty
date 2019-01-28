@extends('backend.layouts.default')
@section('content')

        <!-- START PAGE SIDEBAR -->
        <div class="page-sidebar">
            <!-- START X-NAVIGATION -->
            <ul class="x-navigation">
                <li class="xn-logo">
                    <a href="index.html">{{trans('backend.title')}}</a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="#" class="profile-mini">
                        <img src="{{asset('public/assets/images/users/avatar.jpg')}}" alt="John Doe"/>
                    </a>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="{{ asset('public/assets/images/users/avatar.jpg') }}" alt="John Doe"/>
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name">John Doe</div>
                            <div class="profile-data-title">Web Developer/Designer</div>
                        </div>
                        <div class="profile-controls">
                            <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                            <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                        </div>
                    </div>
                </li>
                <li class="xn-title">Navigation</li>
                <li class="active">
                    <a href="index.html"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
                </li>
                <li class="xn-openable ">
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
                <li class="xn-openable">
                    <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Layouts</span></a>
                    <ul>
                        <li><a href="layout-boxed.html">Boxed</a></li>
                        <li><a href="layout-nav-toggled.html">Navigation Toggled</a></li>
                        <li><a href="layout-nav-toggled-hover.html">Nav Toggled (Hover)</a></li>
                        <li><a href="layout-nav-toggled-item-hover.html">Nav Toggled (Item Hover)</a></li>
                        <li><a href="layout-nav-top.html">Navigation Top</a></li>
                        <li><a href="layout-nav-right.html">Navigation Right</a></li>
                        <li><a href="layout-nav-top-fixed.html">Top Navigation Fixed</a></li>
                        <li><a href="layout-nav-custom.html">Custom Navigation</a></li>
                        <li><a href="layout-nav-top-custom.html">Custom Top Navigation</a></li>
                        <li><a href="layout-frame-left.html">Frame Left Column</a></li>
                        <li><a href="layout-frame-right.html">Frame Right Column</a></li>
                        <li><a href="layout-search-left.html">Search Left Side</a></li>
                        <li><a href="layout-page-sidebar.html">Page Sidebar</a></li>
                        <li><a href="layout-page-loading.html">Page Loading</a></li>
                        <li><a href="layout-rtl.html">Layout RTL</a></li>
                        <li><a href="layout-tabbed.html">Page Tabbed</a><div class="informer informer-danger">New!</div></li>
                        <li><a href="layout-custom-header.html">Custom Header</a><div class="informer informer-danger">New!</div></li>
                        <li><a href="layout-adaptive-panels.html">Adaptive Panels</a><div class="informer informer-danger">New!</div></li>
                        <li><a href="blank.html">Blank Page</a></li>
                    </ul>
                </li>
                <li class="xn-title">Components</li>
                <li class="xn-openable">
                    <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">UI Kits</span></a>
                    <ul>
                        <li><a href="ui-widgets.html"><span class="fa fa-heart"></span> Widgets</a></li>
                        <li><a href="ui-elements.html"><span class="fa fa-cogs"></span> Elements</a></li>
                        <li><a href="ui-buttons.html"><span class="fa fa-square-o"></span> Buttons</a></li>
                        <li><a href="ui-panels.html"><span class="fa fa-pencil-square-o"></span> Panels</a></li>
                        <li><a href="ui-icons.html"><span class="fa fa-magic"></span> Icons</a><div class="informer informer-warning">+679</div></li>
                        <li><a href="ui-typography.html"><span class="fa fa-pencil"></span> Typography</a></li>
                        <li><a href="ui-portlet.html"><span class="fa fa-th"></span> Portlet</a></li>
                        <li><a href="ui-sliders.html"><span class="fa fa-arrows-h"></span> Sliders</a></li>
                        <li><a href="ui-alerts-popups.html"><span class="fa fa-warning"></span> Alerts & Popups</a></li>
                        <li><a href="ui-lists.html"><span class="fa fa-list-ul"></span> Lists</a></li>
                        <li><a href="ui-tour.html"><span class="fa fa-random"></span> Tour</a></li>
                        <li><a href="ui-nestable.html"><span class="fa fa-sitemap"></span> Nestable List</a></li>
                        <li><a href="ui-autocomplete.html"><span class="fa fa-search-plus"></span> Autocomplete</a></li>
                        <li><a href="ui-slide-menu.html"><span class="fa fa-angle-right"></span> Slide Menu</a><div class="informer informer-danger">New!</div></li>
                    </ul>
                </li>
                <li class="xn-openable">
                    <a href="#"><span class="fa fa-pencil"></span> <span class="xn-text">Forms</span></a>
                    <ul>
                        <li class="xn-openable">
                            <a href="form-layouts-two-column.html"><span class="fa fa-tasks"></span> Form Layouts</a>
                            <ul>
                                <li><a href="form-layouts-one-column.html"><span class="fa fa-align-justify"></span> One Column</a></li>
                                <li><a href="form-layouts-two-column.html"><span class="fa fa-th-large"></span> Two Column</a></li>
                                <li><a href="form-layouts-tabbed.html"><span class="fa fa-table"></span> Tabbed</a></li>
                                <li><a href="form-layouts-separated.html"><span class="fa fa-th-list"></span> Separated Rows</a></li>
                            </ul>
                        </li>
                        <li><a href="form-elements.html"><span class="fa fa-file-text-o"></span> Elements</a></li>
                        <li><a href="form-validation.html"><span class="fa fa-list-alt"></span> Validation</a></li>
                        <li><a href="form-wizards.html"><span class="fa fa-arrow-right"></span> Wizards</a></li>
                        <li><a href="form-editors.html"><span class="fa fa-text-width"></span> WYSIWYG Editors</a></li>
                        <li><a href="form-file-handling.html"><span class="fa fa-floppy-o"></span> File Handling</a></li>
                    </ul>
                </li>
                <li class="xn-openable">
                    <a href="tables.html"><span class="fa fa-table"></span> <span class="xn-text">Tables</span></a>
                    <ul>
                        <li><a href="table-basic.html"><span class="fa fa-align-justify"></span> Basic</a></li>
                        <li><a href="table-datatables.html"><span class="fa fa-sort-alpha-desc"></span> Data Tables</a></li>
                        <li><a href="table-export.html"><span class="fa fa-download"></span> Export Tables</a></li>
                    </ul>
                </li>
                <li class="xn-openable">
                    <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Charts</span></a>
                    <ul>
                        <li><a href="charts-morris.html">Morris</a></li>
                        <li><a href="charts-nvd3.html">NVD3</a></li>
                        <li><a href="charts-rickshaw.html">Rickshaw</a></li>
                        <li><a href="charts-other.html">Other</a></li>
                    </ul>
                </li>
                <li>
                    <a href="maps.html"><span class="fa fa-map-marker"></span> <span class="xn-text">Maps</span></a>
                </li>
                <li class="xn-openable">
                    <a href="#"><span class="fa fa-sitemap"></span> <span class="xn-text">Navigation Levels</span></a>
                    <ul>
                        <li class="xn-openable">
                            <a href="#">Second Level</a>
                            <ul>
                                <li class="xn-openable">
                                    <a href="#">Third Level</a>
                                    <ul>
                                        <li class="xn-openable">
                                            <a href="#">Fourth Level</a>
                                            <ul>
                                                <li><a href="#">Fifth Level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
            <!-- END X-NAVIGATION -->
        </div>
        <!-- END PAGE SIDEBAR -->

        <!-- PAGE CONTENT -->
        <div class="page-content">


            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li><a href="#">{{trans('backend.breadcrumbs.home')}}</a></li>
                <li class="">{{trans('backend.breadcrumbs.dashboard')}}</li>
            </ul>
            <!-- END BREADCRUMB -->

            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">

                <!-- START WIDGETS -->
                <div class="row">
                    <div class="col-md-3">

                        <!-- START WIDGET SLIDER -->
                        <div class="widget widget-default widget-carousel">
                            <div class="owl-carousel" id="owl-example">
                                <div>
                                    <div class="widget-title">{{trans('backend.dashboard.total_orders')}}</div>
                                    <div class="widget-subtitle"></div>
                                    <div class="widget-int">{{$total_orders}}</div>
                                </div>
                                <div>
                                    <div class="widget-title">{{trans('backend.dashboard.unconfirmed')}}</div>
                                    <div class="widget-subtitle"></div>
                                    <div class="widget-int">{{$unconfirmed_orders}}</div>
                                </div>
                                <div>
                                    <div class="widget-title">{{trans('backend.dashboard.new_orders')}}</div>
                                    <div class="widget-subtitle"></div>
                                    <div class="widget-int">{{$new_orders}}</div>
                                </div>
                            </div>

                        </div>
                        <!-- END WIDGET SLIDER -->

                    </div>
                    <div class="col-md-3">

                        <!-- START WIDGET MESSAGES -->
                        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                            <div class="widget-item-left">
                                <span class="fa fa-envelope"></span>
                            </div>
                            <div class="widget-data">
                                <div class="widget-int num-count">{{$messages_count}}</div>
                                <div class="widget-title">{{trans('backend.dashboard.messages')}}</div>
                                <div class="widget-subtitle">{{trans('backend.dashboard.in_your_mail_box')}}</div>
                            </div>

                        </div>
                        <!-- END WIDGET MESSAGES -->

                    </div>
                    <div class="col-md-3">

                        <!-- START WIDGET REGISTRED -->
                        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
                            <div class="widget-item-left">
                                <span class="fa fa-user"></span>
                            </div>
                            <div class="widget-data">
                                <div class="widget-int num-count">{{$activated_users}}</div>
                                <div class="widget-title">{{trans('backend.dashboard.registered_users')}}</div>
                                <div class="widget-subtitle">{{trans('backend.dashboard.on_your_website')}}</div>
                            </div>

                        </div>
                        <!-- END WIDGET REGISTRED -->

                    </div>
                    <div class="col-md-3">

                        <!-- START WIDGET CLOCK -->
                        <div class="widget widget-danger widget-padding-sm">
                            <div class="widget-big-int plugin-clock">00:00</div>
                            <div class="widget-subtitle plugin-date">Loading...</div>

                            <div class="widget-buttons widget-c3">
                                <div class="col">
                                    <a href="#"><span class="fa fa-clock-o"></span></a>
                                </div>
                                <div class="col">
                                    <a href="#"><span class="fa fa-bell"></span></a>
                                </div>
                                <div class="col">
                                    <a href="#"><span class="fa fa-calendar"></span></a>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET CLOCK -->

                    </div>
                </div>
                <!-- END WIDGETS -->

                <div class="row">
                    <div class="col-md-8">

                        <!-- START SALES BLOCK -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Sales</h3>
                                    <span>Sales activity by period you selected</span>
                                </div>
                                <ul class="panel-controls panel-controls-title">
                                    <li>
                                        <div id="reportrange" class="dtrange">
                                            <span></span><b class="caret"></b>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                            <div class="panel-body">
                                <div class="row stacked">
                                    <div class="col-md-4">
                                        <div class="progress-list">
                                            <div class="pull-left"><strong>{{trans('backend.dashboard.unconfirmed')}}</strong></div>
                                            <div class="pull-right" id="unconfirmed"> {{$unconfirmed_orders}}</div>
                                            <div class="progress progress-small progress-striped active">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$unconfirmed_orders}}%;" id="unconfirmed-bar">{{$unconfirmed_orders}}</div>
                                            </div>
                                        </div>
                                        <div class="progress-list">
                                            <div class="pull-left"><strong>{{trans('backend.dashboard.new_orders')}}</strong></div>
                                            <div class="pull-right" id="new-orders">{{$new_orders}}</div>
                                            <div class="progress progress-small progress-striped active">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$new_to_total_percentage}}%;" id="new-orders-bar">{{$new_to_total_percentage}}%</div>
                                            </div>
                                        </div>
                                        <div class="progress-list">
                                            <div class="pull-left"><strong class="text-danger">{{trans('backend.dashboard.on_progress_orders')}}</strong></div>
                                            <div class="pull-right" id="onprogress-orders">{{$onprogress_orders}}</div>
                                            <div class="progress progress-small progress-striped active">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$onprogress_orders}}%;" id="onprogress-orders-bar">{{$onprogress_orders}}%</div>
                                            </div>
                                        </div>
                                        <div class="progress-list">
                                            <div class="pull-left"><strong class="text-warning">{{trans('backend.dashboard.delivered')}}</strong></div>
                                            <div class="pull-right" id="delivered-orders">{{$delivered_orders}}</div>
                                            <div class="progress progress-small progress-striped active">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$delivered_orders}}%;" id="delivered-orders-bar">{{$delivered_orders}}%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div id="dashboard-map-seles" style="width: 100%; height: 200px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END SALES BLOCK -->

                    </div>
                    <div class="col-md-4">

                        <!-- START PROJECTS BLOCK -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Projects</h3>
                                    <span>Projects activity</span>
                                </div>
                                <ul class="panel-controls" style="margin-top: 2px;">
                                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body panel-body-table">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="50%">Project</th>
                                            <th width="20%">Status</th>
                                            <th width="30%">Activity</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><strong>Atlant</strong></td>
                                            <td><span class="label label-danger">Developing</span></td>
                                            <td>
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">85%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gemini</strong></td>
                                            <td><span class="label label-warning">Updating</span></td>
                                            <td>
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">40%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Taurus</strong></td>
                                            <td><span class="label label-warning">Updating</span></td>
                                            <td>
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">72%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Leo</strong></td>
                                            <td><span class="label label-success">Support</span></td>
                                            <td>
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Virgo</strong></td>
                                            <td><span class="label label-success">Support</span></td>
                                            <td>
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Aquarius</strong></td>
                                            <td><span class="label label-success">Support</span></td>
                                            <td>
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- END PROJECTS BLOCK -->

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">

                        <!-- START SALES & EVENTS BLOCK -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>{{trans('backend.dashboard.sales')}}</h3>
                                    <span>Event "Purchase Button"</span>
                                </div>
                                <ul class="panel-controls" style="margin-top: 2px;">
                                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body padding-0">
                                <div class="chart-holder" id="dashboard-line-1" style="height: 200px;"></div>
                            </div>
                        </div>
                        <!-- END SALES & EVENTS BLOCK -->

                    </div>
                    <div class="col-md-4">

                        <!-- START USERS ACTIVITY BLOCK -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Users Activity</h3>
                                    <span>Users vs returning</span>
                                </div>
                                <ul class="panel-controls" style="margin-top: 2px;">
                                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body padding-0">
                                <div class="chart-holder" id="dashboard-bar-1" style="height: 200px;"></div>
                            </div>
                        </div>
                        <!-- END USERS ACTIVITY BLOCK -->

                    </div>
                    <div class="col-md-4">

                        <!-- START VISITORS BLOCK -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Visitors</h3>
                                    <span>Visitors (last month)</span>
                                </div>
                                <ul class="panel-controls" style="margin-top: 2px;">
                                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body padding-0">
                                <div class="chart-holder" id="dashboard-donut-1" style="height: 200px;"></div>
                            </div>
                        </div>
                        <!-- END VISITORS BLOCK -->

                    </div>
                </div>

                <!-- START DASHBOARD CHART -->
                <div class="block-full-width">
                    <div id="dashboard-chart" style="height: 250px; width: 100%; float: left;"></div>
                    <div class="chart-legend">
                        <div id="dashboard-legend"></div>
                    </div>
                </div>
                <!-- END DASHBOARD CHART -->

            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTENT -->
@endsection
@section('message-box')
<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to log out?</p>
                <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let site_url = '{{url('/')}}';
</script>
<!-- END MESSAGE BOX-->
@endsection









