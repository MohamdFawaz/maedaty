@extends('backend.layouts.default')
@section('content')

    <div class="page-head">
        <div class="page-head-text">
            <h1>{{trans('backend.shop.details')}}</h1>
        </div>
        <div class="page-head-controls">
            <a  href="{{route('backend.shop_branch.edit',$shop_branch->id)}}" class="btn btn-success btn-rounded"><span class="fa fa-pencil"></span>{{trans('backend.action.edit')}}</a>
        </div>
    </div>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap" style="padding: 10px">

    <div class="row" style="padding-top: 10px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{trans('backend.shop_branch.shop')}}</h3>
                    <p>{{$shop_branch->shop->name}}</p>

                    <h3>{{trans('backend.shop_branch.address')}}</h3>
                    <p>{{$shop_branch->address}}</p>

                    <h3>{{trans('backend.shop_branch.location')}}</h3>

                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-body panel-body-map">
                                <div class="col-md-6 col-xs-12">
                                    <div id="map" style="width: 100%; height: 300px; float: right;"></div>
                                </div>
                            </div>
                            {{--<iframe src = "https://maps.google.com/maps?q={{$shop_branch->lat}},{{$shop_branch->lng}}&hl=es;z=14&amp;output=embed"></iframe>--}}
                            <input type="hidden" value="{{$shop_branch->lat}}" id="mylat" name="lat">
                            <input type="hidden" value="{{$shop_branch->lng}}" id="mylng" name="lng">
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <!-- END PAGE CONTENT WRAPPER -->

@endsection
@section('script')
    <script type="text/javascript">
        var marker;

        var map, infoWindow;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: parseFloat(mylat.value), lng: parseFloat(mylng.value)},
                zoom: 18

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







