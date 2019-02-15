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
                            <table class="table datatable" id="products-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.review.id')}}</th>
                                    <th>{{trans('backend.review.username')}}</th>
                                    <th>{{trans('backend.review.on_product')}}</th>
                                    <th>{{trans('backend.review.comment')}}</th>
                                    <th>{{trans('backend.review.rate_value')}}</th>
                                    <th>{{trans('backend.review.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userReviews as $userReview)
                                <tr>
                                    <td>{{$userReview->id}}</td>
                                    <td>{{$userReview->user->full_name}}</td>
                                    <td>{{$userReview->product->translate()->name}}</td>
                                    <td>{{$userReview->comment}}</td>
                                    <td>{!! $userReview->rate_value_stars !!}</td>
                                    <td>{!! $userReview->action !!}</td>
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
        $(".delete-review-btn").click(function(){
            var review_id = $(this).data('id');
            var user_name = $(this).data('name');
            $('#user-name').text(user_name);
            var url  = '{{route("backend.review.delete",":id")}}';
            url = url.replace(':id',review_id);
            $("#delete-ref").attr("href",url);
            $('#mb-delete-review').addClass('open');
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







