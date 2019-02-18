@extends('backend.layouts.default')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('backend.notification.list')}}</h3>
                        <ul class="panel-controls">
                                <span class="btn btn-success" data-toggle="modal" data-target="#create-notification">{{trans('backend.action.create')}}</span>
                            {{--<button class="btn btn-success btn-rounded" ><span class="fa fa-pencil"></span>{{trans('backend.action.create')}}</button>--}}
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="products-table">
                                <thead>
                                <tr>
                                    <th>{{trans('backend.notification.id')}}</th>
                                    <th>{{trans('backend.notification.title_ar')}}</th>
                                    <th>{{trans('backend.notification.text_ar')}}</th>
                                    <th>{{trans('backend.notification.title_en')}}</th>
                                    <th>{{trans('backend.notification.text_en')}}</th>
                                    <th>{{trans('backend.notification.image')}}</th>
                                    <th>{{trans('backend.notification.user')}}</th>
                                    <th>{{trans('backend.notification.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notifications as $notification)
                                <tr>
                                    <td>{{$notification->id}}</td>
                                    <td>{{$notification->translate('ar')['title']}}</td>
                                    <td>{{$notification->translate('ar')['message']}}</td>
                                    <td>{{$notification->translate('en')['title']}}</td>
                                    <td>{{$notification->translate('en')['message']}}</td>
                                    <td><img src="{{$notification->image}}" alt="notification_image" style="width: 100px;"/> </td>
                                    <td>{{ $notification->target_user }}</td>
                                    <td>{!! $notification->action !!}</td>
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
    <div class="modal fade" id="create-notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('backend.notification.send')}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
                <form action="{{route('backend.notification.store')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        {{method_field('post')}}

                        <div class="form-group">
                            <label for="title_ar">{{trans('backend.notification.title_ar')}}</label>
                            <input name="title_ar" id="title_ar" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="text_ar">{{trans('backend.notification.text_ar')}}</label>
                            <input name="text_ar" id="text_ar" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="title_en">{{trans('backend.notification.title_en')}}</label>
                            <input name="title_en" id="title_en" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="text_en">{{trans('backend.notification.text_en')}}</label>
                            <input name="text_en" id="text_en" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="target">{{trans('backend.user.list')}}</label>
                            <select name="target" id="target" class="form-control">
                                <option value="">{{trans('messages.choose_option')}}</option>
                                <option value="all">{{trans('backend.notification.all')}}</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                        <label for="target">{{trans('backend.notification.image')}}</label>
                        <div class="image-upload friend" >
                            <label for="file-input" class="image-upload-label">
                                <img alt="notification-image" src="{{asset('public/images/notification/maedaty-logo.jpg')}}" class="thumb" style="width: 300px"/>
                            </label>
                            <input name="notification_image" id="file-input" type="file"/>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('backend.action.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{trans('backend.action.submit')}}</button>
                    </div>
                    </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- MESSAGE BOX-->
    <div class="message-box message-box-danger animated fadeIn" id="mb-delete-notification">
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
        $(".delete-notification-btn").click(function(){
            var not_id = $(this).data('id');
            var url  = '{{route("backend.notification.delete",":id")}}';
            url = url.replace(':id',not_id);
            $(".delete-ref").attr("href",url);
            $('#mb-delete-notification').addClass('open');
        });
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.thumb').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file-input").change(function() {
            readURL(this);
        });
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







