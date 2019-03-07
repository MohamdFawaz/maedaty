@extends('backend.layouts.default')
@section('content')

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
                    @role('Super Admin')
                    <div class="col-md-3">

                        <!-- START WIDGET MESSAGES -->
                        <div class="widget widget-default widget-item-icon" >
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
                    @endrole

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
                                    <div class="col-md-6">
                                        <div id="dashboard-map-seles" style="width: 100%; height: 200px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END SALES BLOCK -->

                    </div>
                    <!--<div class="col-md-4">-->

                        <!-- START PROJECTS BLOCK -->
                        <!--<div class="panel panel-default">
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
                        </div>-->
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
                    <div id="dashboard-chart" style="height: 1px; width: 100%; float: left;"></div>
                    <div class="chart-legend">
                        <div id="dashboard-legend"></div>
                    </div>
                </div>
                <!-- END DASHBOARD CHART -->

            <!-- END PAGE CONTENT WRAPPER -->


<!-- MESSAGE BOX-->
    <div class="message-box message-box-danger animated fadeIn" data-sound="alert" id="mb-signout">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>  <strong>{{trans('backend.action.delete')}}</strong> ?</div>
                <div class="mb-content">
                    <p></p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a href="{{'admin/logout'}}" class="btn btn-success btn-lg">{{trans('backend.action.yes')}}</a>
                        <button class="btn btn-default btn-lg mb-control-close">{{trans('backend.action.no')}}</button>
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









