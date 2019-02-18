@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.admin.list')}}</h3>
                        <ul class="panel-controls">
                            <a href="{{route('backend.admin.create')}}" >
                                <span class="btn btn-success">{{trans('backend.action.create')}}</span>
                            </a>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="admins-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.admin.id')}}</th>
                                    <th>{{trans('backend.admin.full_name')}}</th>
                                    <th>{{trans('backend.admin.phone')}}</th>
                                    <th>{{trans('backend.admin.email')}}</th>
                                    <th>{{trans('backend.admin.user_image')}}</th>
                                    <th>{{trans('backend.admin.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->full_name}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->email}}</td>
                                    <td width="10%"><a href="{{$user->user_image}}" target="_blank"> <img src="{{$user->user_image}}" alt="user-image" style="width: 30%"/></a></td>
                                    <td>{!! $user   ->admin_action !!}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END DEFAULT DATATABLE -->



            </div>
        </div>

    </div>
    <!-- PAGE CONTENT WRAPPER -->
    <!-- MESSAGE BOX-->
    <div class="message-box message-box-danger animated fadeIn" id="mb-delete-admin">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>{{trans('backend.action.delete')}} <strong id="admin-name"></strong>?</div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a id="delete-ref" class="btn btn-success btn-lg">Yes</a>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MESSAGE BOX-->
@endsection
@section('script')
    <script type="text/javascript">
        $(".delete-admin-btn").click(function(){
            var user_id = $(this).data('id');
            var admin_name = $(this).data('name');
            $('#admin-name').text(admin_name);
            var url  = '{{route("backend.admin_users.delete",":id")}}';
            url = url.replace(':id',user_id);
            $("#delete-ref").attr("href",url);
            $('#mb-delete-admin').addClass('open');
        });
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







