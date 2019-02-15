@extends('backend.layouts.default')
@section('content')

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form class="tocify-content" action="{{route('backend.shop_branch.store')}}" method="POST">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="shop_id">{{trans('backend.shop_branch.shop')}}</label>
                                <select class="form-control" name="shop_id" id="shop_id">
                                    <option value="">{{trans('messages.choose_option')}}</option>
                                    @foreach($shops as $shop)
                                        <option value="{{$shop->id}}">{{$shop->name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('shop_id') }}</small>

                            </div>


                            <div class="form-group">
                                <label for="address">{{trans('backend.shop_branch.address')}}</label>
                                <input id="address" type="text" name="address" class="form-control" >
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-body panel-body-map">
                                    <div class="col-md-6 col-xs-12">
                                        <div id="map" style="width: 100%; height: 300px; float: right;"></div>
                                    </div>
                                </div>
                                <input type="hidden" value="24.7136" id="mylat" name="lat">
                                <input type="hidden" value="46.6753" id="mylng" name="lng">
                            </div>
                            <small class="text-danger">{{ $errors->first('lat') }}</small>

                            <input type="submit" class="btn btn-success" value="{{trans('backend.action.edit')}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- END PAGE CONTENT WRAPPER -->

        @endsection
        @section('script')
            <script type="text/javascript">
                var map;


                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: parseFloat(mylat.value), lng: parseFloat(mylng.value)},
                        zoom: 12

                    });


                    var pos = {
                        lat: parseFloat(mylat.value),
                        lng: parseFloat(mylng.value)
                    };

                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        title: 'هنا !'

                    });
                    google.maps.event.addListener(marker, "position_changed", function() {
                        var position = marker.getPosition();
                        console.log(position.lat(),position.lng());
                        $('#mylat').val(position.lat());
                        $('#mylng').val(position.lng());

                    });
                }


            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhnmMC23noePz6DA8iEvO9_yNDGGlEaeM&callback=initMap">
            </script>
            <!-- THIS PAGE PLUGINS -->
            <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

            <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
            <!-- END PAGE PLUGINS -->

@endsection







