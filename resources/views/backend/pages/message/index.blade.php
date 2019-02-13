@extends('backend.layouts.default')
@section('content')

    <div class="page-content-wrap" style="padding:10px;">
        <h3 class=" text-center">Messaging</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        @foreach($inbox_users as $inbox_user)
                        <div class="chat_list" data-user-id="{{$inbox_user->owner->id}}">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="{{$inbox_user->owner->user_image}}" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>{{$inbox_user->owner->full_name}} <span class="chat_date">{{$inbox_user->human_created_at}}</span></h5>
                                    <p>{{$inbox_user->body}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mesgs">
                    <div class="msg_history">
                        {{--<div class="incoming_msg">--}}
                            {{--<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                            {{--<div class="received_msg">--}}
                                {{--<div class="received_withd_msg">--}}
                                    {{--<p>Test which is a new approach to have all--}}
                                        {{--solutions</p>--}}
                                    {{--<span class="time_date"> 11:01 AM    |    June 9</span></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="outgoing_msg">--}}
                            {{--<div class="sent_msg">--}}
                                {{--<p>Test which is a new approach to have all--}}
                                    {{--solutions</p>--}}
                                {{--<span class="time_date"> 11:01 AM    |    June 9</span> </div>--}}
                        {{--</div>--}}
                        {{--<div class="incoming_msg">--}}
                            {{--<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                            {{--<div class="received_msg">--}}
                                {{--<div class="received_withd_msg">--}}
                                    {{--<p>Test, which is a new approach to have</p>--}}
                                    {{--<span class="time_date"> 11:01 AM    |    Yesterday</span></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="outgoing_msg">--}}
                            {{--<div class="sent_msg">--}}
                                {{--<p>Apollo University, Delhi, India Test</p>--}}
                                {{--<span class="time_date"> 11:01 AM    |    Today</span> </div>--}}
                        {{--</div>--}}
                        {{--<div class="incoming_msg">--}}
                            {{--<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>--}}
                            {{--<div class="received_msg">--}}
                                {{--<div class="received_withd_msg">--}}
                                    {{--<p>We work directly with our designers and suppliers,--}}
                                        {{--and sell direct to you, which means quality, exclusive--}}
                                        {{--products, at a price anyone can afford.</p>--}}
                                    {{--<span class="time_date"> 11:01 AM    |    Today</span></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <input type="text" class="write_msg" placeholder="Type a message" />
                            <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center top_spac"> Design by <a target="_blank" href="#">Sunil Rajput</a></p>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var inconming = ' <div class="incoming_msg">\n' +
            '<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\n' +
            '<div class="received_msg">\n' +
            '<div class="received_withd_msg">\n' +
            '<p>Test which is a new approach to have all\n' +
            'solutions</p>\n' +
            '<span class="time_date"> 11:01 AM    |    June 9</span></div>\n' +
            '</div>\n' +
            '</div>';
        var outgoing = '<div class="outgoing_msg">\n' +
            '<div class="sent_msg">\n' +
            '<p>Test which is a new approach to have all\n' +
            'solutions</p>\n' +
            '<span class="time_date"> 11:01 AM    |    June 9</span> </div>\n' +
            '</div>';
        $('.chat_list').click(function () {
            $('.chat_list').removeClass('active_chat');
            $(this).addClass('active_chat');
            var user_id = $(this).attr('data-user-id');
            var data = {user_id};
            $.ajax({
                type:"POST",
                url: '{{route('backend.list.messages')}}',
                data: data ,
                success: function(data){
                    var msgHistory = $('.msg_history');
                    console.log(data);
                    msgHistory.empty();
                        $.each(data,function (k,v) {
                            console.log(v.owner.user_image);
                        if (v.user == 'admin') {
                            msgHistory.append('<div class="outgoing_msg">'+
                                '<div class="sent_msg">'+
                                '<p>'+v.body+
                                '</p>'+
                                '<span class="time_date"> 11:01 AM    |    June 9</span> </div>'+
                                '</div>');
                        } else {
                            msgHistory.append('<div class="incoming_msg">'+
                                '<div class="incoming_msg_img"> <img src="'+v.owner+'" alt="sunil"> </div>'+
                                '<div class="received_msg">'+
                                '<div class="received_withd_msg">'+
                                '<p>'+v.body +
                                '</p>'+
                                '<span class="time_date"> 11:01 AM    |    June 9</span></div>'+
                                '</div>'+
                                '</div>');
                        }
                        })

                }

            });

        });

    </script>
@endsection