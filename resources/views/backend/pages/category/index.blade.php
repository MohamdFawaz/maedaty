@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.category.list')}}</h3>
                        <ul class="panel-controls">
                            <a href="{{route('backend.category.create')}}" >
                                <span class="btn btn-success">{{trans('backend.action.create')}}</span>
                            </a>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="products-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.category.id')}}</th>
                                    <th>{{trans('backend.category.name_ar')}}</th>
                                    <th>{{trans('backend.category.name_en')}}</th>
                                    <th>{{trans('backend.category.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->translate('ar')['name']}}</td>
                                    <td>{{$category->translate('en')['name']}}</td>
                                    <td>{!! $category->action !!}</td>
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
    <div class="message-box message-box-danger animated fadeIn" data-sound="alert" id="mb-delete-category">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>  <strong>{{trans('backend.action.asas')}}</strong> ?</div>
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
    <!-- PAGE CONTENT WRAPPER -->
    <!-- MESSAGE BOX-->
    <div class="message-box message-box-danger animated fadeIn" id="mb-delete-category">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>{{trans('backend.action.delete')}} <strong id="cat-name"></strong> ?</div>
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
        $(".delete-category-btn").click(function(){
            var cat_id = $(this).data('id');
            var cat_name = $(this).data('name');
            $('#cat-name').text(cat_name);
            var url  = '{{route("backend.category.delete",":id")}}';
            url = url.replace(':id',cat_id);
            $("#delete-ref").attr("href",url);
            $('#mb-delete-category').addClass('open');
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







