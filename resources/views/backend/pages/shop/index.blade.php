@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.shop.list')}}</h3>
                        <ul class="panel-controls">
                            <a href="{{route('backend.shop.create')}}" >
                                <span class="btn btn-success">{{trans('backend.action.create')}}</span>
                            </a>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="shops-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.shop.id')}}</th>
                                    <th>{{trans('backend.shop.name_ar')}}</th>
                                    <th>{{trans('backend.shop.name_en')}}</th>
                                    <th>{{trans('backend.shop.username')}}</th>
                                    <th>{{trans('backend.shop.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shops as $shop)
                                <tr>
                                    <td>{{$shop->id}}</td>
                                    <td>{{$shop->translate('ar')['name']}}</td>
                                    <td>{{$shop->translate('en')['name']}}</td>
                                    <td>{{$shop->user->full_name}}</td>
                                    <td>{!! $shop->action !!}</td>
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
@endsection
@section('script')
    <script type="text/javascript">
        $(".delete-subcategory-btn").click(function(){
            var cat_id = $(this).data('id');
            var cat_name = $(this).data('name');
            $('#subcat-name').text(cat_name);
            var url  = '{{route("backend.subcategory.delete",":id")}}';
            url = url.replace(':id',cat_id);
            $("#delete-ref").attr("href",url);
            $('#mb-delete-subcategory').addClass('open');
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







