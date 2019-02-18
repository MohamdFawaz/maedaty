@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.user.list')}}</h3>
                        <ul class="panel-controls">

                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="users-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.user.id')}}</th>
                                    <th>{{trans('backend.user.full_name')}}</th>
                                    <th>{{trans('backend.user.phone')}}</th>
                                    <th>{{trans('backend.user.email')}}</th>
                                    <th>{{trans('backend.user.user_image')}}</th>
                                    <th>{{trans('backend.user.status')}}</th>
                                    <th>{{trans('backend.user.action')}}</th>

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
                                    <td>{!! $user   ->status_label !!}</td>
                                    <td>{!! $user   ->action !!}</td>
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
    <div class="message-box message-box-danger animated fadeIn" id="mb-delete-review">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>{{trans('backend.action.delete')}} <strong id="user-name"></strong> {{trans('backend.review.review')}}?</div>
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
        $(".status").change(function(){

            var user_id=$(this).attr('id');
            var status_val=$(this).attr('value');
            var status_label=$("#label-"+user_id);
            if(status_val==0)
            {
                status_val=1;
                $('#'+user_id).val("1");
            }else{
                status_val=0;
                $('#'+user_id).val("0");
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{url()->current()."/updateStatus"}}',
                {user_id:user_id,status:status_val},
                function(data){
                console.log(data);
                    if(data.success){
                        if(data.status == 1){
                            status_label.toggleClass('label-danger label-success');
                            status_label.html('{{trans('backend.user.not_suspended')}}');
                        }else{
                            status_label.toggleClass('label-danger label-success');
                            status_label.html('{{trans('backend.user.suspended')}}');
                        }
                    }

                });
        });
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







