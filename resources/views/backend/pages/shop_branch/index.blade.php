@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.shop_branch.list')}}</h3>
                        <ul class="panel-controls">
                            <a href="{{route('backend.shop_branch.create')}}" >
                                <span class="btn btn-success">{{trans('backend.action.create')}}</span>
                            </a>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="shop-branch-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.shop_branch.id')}}</th>
                                    <th>{{trans('backend.shop_branch.shop')}}</th>
                                    <th>{{trans('backend.shop_branch.address')}}</th>
                                    <th>{{trans('backend.shop_branch.location')}}</th>
                                    <th>{{trans('backend.shop.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shopBranches as $shopBranch)
                                <tr>
                                    <td>{{$shopBranch->id}}</td>
                                    <td>{{$shopBranch->shop->name}}</td>
                                    <td>{{$shopBranch->address}}</td>
                                    <td><a href="http://maps.google.com/?q={{$shopBranch->lat}},{{$shopBranch->lng}}" target="_blank">{{trans('backend.shop_branch.location')}}</a></td>
                                    <td>{!! $shopBranch->action !!}</td>
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
    <div class="message-box message-box-danger animated fadeIn" id="mb-delete-branch">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>{{trans('backend.question.are_you_sure_delete')}}</div>
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
        $(".delete-branch-btn").click(function(){
            var branch_id = $(this).data('id');
            var url  = '{{route("backend.shop.branch.delete",":id")}}';
            url = url.replace(':id',branch_id);
            $("#delete-ref").attr("href",url);
            $('#mb-delete-branch').addClass('open');
        });
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







