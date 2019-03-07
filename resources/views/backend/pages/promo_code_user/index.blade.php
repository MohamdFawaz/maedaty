@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.promo.list')}}</h3>
                        <ul class="panel-controls">
                                <span class="btn btn-success" data-toggle="modal" data-target="#create-promo">{{trans('backend.action.create')}}</span>
                            {{--<button class="btn btn-success btn-rounded" ><span class="fa fa-pencil"></span>{{trans('backend.action.create')}}</button>--}}
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="promo-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.promo.id')}}</th>
                                    <th>{{trans('backend.promo.code')}}</th>
                                    <th>{{trans('backend.promo.valid_times')}}</th>
                                    <th>{{trans('backend.promo.discount_type')}}</th>
                                    <th>{{trans('backend.promo.discount_amount')}}</th>
                                    <th>{{trans('backend.promo.valid_from')}}</th>
                                    <th>{{trans('backend.promo.valid_to')}}</th>
                                    <th>{{trans('backend.promo.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($promoCodes as $promoCode)
                                <tr>
                                    <td>{{$promoCode->id}}</td>
                                    <td>{{$promoCode->code}}</td>
                                    <td>{{$promoCode->valid_times}}</td>
                                    <td>{{$promoCode->discount_type}}</td>
                                    <td>{{$promoCode->discount_amount}}</td>
                                    <td>{{$promoCode->valid_from}}</td>
                                    <td>{{$promoCode->valid_to}}</td>
                                    <td>{!! $promoCode->action !!}</td>
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
    <!-- MESSAGE BOX-->
    <div class="modal fade" id="create-promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('backend.promo.send')}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
                <form action="{{route('backend.promo.store')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        {{method_field('post')}}

                        <div class="form-group">
                            <label for="code">{{trans('backend.promo.code')}}</label>
                            <input name="code" id="code" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="valid_times">{{trans('backend.promo.valid_times')}}</label>
                            <input type="number" name="valid_times" id="valid_times" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="discount_type">{{trans('backend.promo.discount_type')}}</label>
                            <select name="discount_type" id="discount_type" class="form-control" >
                                <option value="">{{trans('messages.choose_option')}}</option>
                                <option value="fixed">{{trans('backend.promo.fixed')}}</option>
                                <option value="percentage">{{trans('backend.promo.percentage')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="discount_amount">{{trans('backend.promo.discount_amount')}}</label>
                            <input name="discount_amount" id="discount_amount" class="form-control" required/>
                            <span class="help-block">{{trans('backend.promo.percentage_hint')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{trans('backend.promo.range')}}</label>

                            <div class="input-group">
                                <input type="text" name="valid_from" class="form-control datepicker" value="{{Carbon\Carbon::now()->toDateString()}}" required>
                                <span class="input-group-addon add-on"> - </span>
                                <input type="text" name="valid_to" class="form-control datepicker" value="{{Carbon\Carbon::now()->toDateString()}}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('backend.action.close')}}</button>
                            <button type="submit" class="btn btn-primary">{{trans('backend.action.submit')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- MESSAGE BOX-->
    <div class="message-box message-box-danger animated fadeIn" id="mb-delete-promo">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>{{trans('backend.question.are_you_sure_delete')}} </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a id="" class="btn btn-success btn-lg delete-ref">Yes</a>
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
        $(".delete-promo-btn").click(function(){
            var promo_id = $(this).data('id');
            var url  = '{{route("backend.promo.delete",":id")}}';
            url = url.replace(':id',promo_id);
            $(".delete-ref").attr("href",url);
            $('#mb-delete-promo').addClass('open');
        });
        $(".status").change(function(){

            var promo_id=$(this).attr('id');
            var status_val=$(this).attr('value');
            if(status_val==0)
            {
                status_val=1;
                $('#'+promo_id).val("1");
            }else{
                status_val=0;
                $('#'+promo_id).val("0");
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{url()->current()."/updateStatus"}}',
                {promo_id,status:status_val},
                function(data){
                    console.log(data);
                });
        });
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







