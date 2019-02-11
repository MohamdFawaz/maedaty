@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.review.list')}}</h3>
                        <ul class="panel-controls">

                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="suggestion-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.suggestion.id')}}</th>
                                    <th>{{trans('backend.suggestion.username')}}</th>
                                    <th>{{trans('backend.suggestion.comment')}}</th>
                                    <th>{{trans('backend.suggestion.date')}}</th>
                                    <th>{{trans('backend.suggestion.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($suggestions as $suggestion)
                                <tr>
                                    <td>{{$suggestion->id}}</td>
                                    <td>{{$suggestion->user->full_name}}</td>
                                    <td>{{$suggestion->comment}}</td>
                                    <td>{{ $suggestion->created_at}}</td>
                                    <td>{!! $suggestion->action !!}</td>
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
    <div class="message-box message-box-danger animated fadeIn" id="mb-delete-suggestion">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>{{trans('backend.action.delete')}} <strong id="user-name"></strong> {{trans('backend.suggestion.suggestion')}}?</div>
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
        $(".delete-suggestion-btn").click(function(){
            var suggestion_id = $(this).data('id');
            var user_name = $(this).data('name');
            $('#user-name').text(user_name);
            var url  = '{{route("backend.suggestion.delete",":id")}}';
            url = url.replace(':id',suggestion_id);
            $("#delete-ref").attr("href",url);
            $('#mb-delete-suggestion').addClass('open');
        });
        $(document).ready(function() {
            $('.datatable').dataTable( {
                "lengthMenu": [5, 7, 10],
                "pageLength": 5
            } );
        } );
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







