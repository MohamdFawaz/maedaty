@extends('backend.layouts.default')
@section('content')

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <form class="tocify-content" action="{{route('backend.settings.update',1)}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="terms_and_conditions_ar">{{trans('backend.setting.terms_and_conditions_ar')}}</label>
                            <textarea type="text" name="terms_and_conditions_ar" id="terms_and_conditions_ar" class="form-control">
                                 {{$setting->terms_and_conditions_ar}}
                            </textarea>
                            <small class="text-danger">{{ $errors->first('terms_and_conditions_ar') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="terms_and_conditions_en">{{trans('backend.setting.terms_and_conditions_en')}}</label>
                            <textarea type="text" name="terms_and_conditions_en" id="terms_and_conditions_en" class="form-control">
                                 {{$setting->terms_and_conditions_en}}
                            </textarea>
                            <small class="text-danger">{{ $errors->first('terms_and_conditions_en') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="about_us_ar">{{trans('backend.setting.about_us_ar')}}</label>
                            <textarea type="text" name="about_us_ar" id="about_us_ar" class="form-control">
                                 {{$setting->about_us_ar}}
                            </textarea>
                            <small class="text-danger">{{ $errors->first('about_us_ar') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="about_us_en">{{trans('backend.setting.about_us_en')}}</label>
                            <textarea type="text" name="about_us_en" id="about_us_en" class="form-control">
                                 {{$setting->about_us_en}}
                            </textarea>
                            <small class="text-danger">{{ $errors->first('about_us_en') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="sms_username">{{trans('backend.setting.sms_username')}}</label>
                            <input type="text" name="sms_username" id="sms_username" class="form-control" value="{{$setting->sms_username}}">
                            <small class="text-danger">{{ $errors->first('sms_username') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="sms_password">{{trans('backend.setting.sms_password')}}</label>
                            <input type="text" name="sms_password" id="sms_password" class="form-control" value="{{$setting->sms_password}}">
                            <small class="text-danger">{{ $errors->first('sms_password') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="sms_message">{{trans('backend.setting.sms_message')}}</label>
                            <input type="text" name="sms_message" id="sms_message" class="form-control" value="{{$setting->sms_message}}">
                            <small class="text-danger">{{ $errors->first('sms_message') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="sms_sender">{{trans('backend.setting.sms_sender')}}</label>
                            <input type="text" name="sms_sender" id="sms_sender" class="form-control" value="{{$setting->sms_sender}}">
                            <small class="text-danger">{{ $errors->first('sms_sender') }}</small>
                        </div>
                        <div class="form-group">
                            <div id="point-rules" class="rules">
                                @foreach($points_rules as $rule)
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="range">{{trans('backend.setting.range')}}</label><span class="text-info"> {{trans('backend.setting.points_range_example')}}</span>
                                        <input type="text" name="range[]" id="range" class="form-control" value="{{$rule->range}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="amount">{{trans('backend.setting.amount')}}</label>
                                        <input type="text" name="amount[]" id="amount" class="form-control" value="{{$rule->amount}}">
                                    </div>
                                </div>
                                @endforeach
                                    <div style="padding:10px 10px" >
                                        <div class="btn btn-info btn-condensed remove-last-elem"><i class="fa fa-minus"></i></div>
                                    </div>
                            </div>

                            <div class="col-md-4" style="padding-top: 20px">
                                <div id="add-more-rule" class="btn btn-info btn-condensed"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                        <div class="form-group col-md-12" style="padding-top: 10px">
                        <input type="submit" class="btn btn-success" value="{{trans('backend.action.edit')}}">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- END PAGE CONTENT WRAPPER -->

@endsection
@section('script')
    <script type="text/javascript">
        $('#add-more-rule').click(function () {
            var new_elem = '<div class="row">\n' +
                '<div class="col-md-6">\n' +
                '<label for="range">{{trans('backend.setting.range')}}</label>\n' +
                '<input type="text" name="range[]" id="range" class="form-control">\n' +
                '</div>\n' +
                '<div class="col-md-6">\n' +
                '<label for="amount">{{trans('backend.setting.amount')}}</label>\n' +
                '<input type="text" name="amount[]" id="amount" class="form-control">\n' +
                '</div>\n' +
                '</div>\n';
            $('.rules').append(new_elem);
        });

        $('.remove-last-elem').click(function () {
            var all_row = $('.rules div.row');
            if(all_row.length > 1){
                var row = $('.rules div.row:last').last();
                row.remove();
            }
        });

    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







