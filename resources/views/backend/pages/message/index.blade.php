@extends('backend.layouts.default')
@section('content')

    <div class="page-content-wrap" style="padding:10px;">
        <h3 class=" text-center">{{trans('backend.message.admin_chat')}}</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <img src="{{asset('public/img/loading.gif')}}" alt="loader" class="loader" style="display: none;padding: 170px 195px">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>{{trans('backend.message.recent')}}</h4>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        @foreach($inbox_users as $inbox_user)
                        <div class="chat_list" data-user-id="{{$inbox_user->owner->id}}">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="{{$inbox_user->owner->user_image}}" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>{{$inbox_user->owner->full_name}} <span class="chat_date">{{$inbox_user->human_created_at}}</span></h5>
                                    <p id="latest-{{$inbox_user->owner->id}}">{{$inbox_user->body}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mesgs">
                    <div class="msg_history">
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <input type="text" class="write_msg" placeholder="Type a message" data-user-id="" />
                            <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
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
        $('.chat_list').click(function () {
            $('.chat_list').removeClass('active_chat');
            $(this).addClass('active_chat');
            var user_id = $(this).attr('data-user-id');
            $('.msg_send_btn').attr('data-user-id', user_id);

            var data = {user_id};
            function update() {
                $.ajax({
                    type: "POST",
                    url: '{{route('backend.list.messages')}}',
                    data: data,
                    dataType:'json',
                    success: function (data) {
                        var msgHistory = $('.msg_history');
                        msgHistory.empty();
                        $.each(data, function (k, v) {
                            var dt = new Date(v.created_at);
                            var time = moment(dt).format('HH:mm A');
                            var month = moment(dt).format("D MMMM");
                            if (v.user == 'admin') {
                                msgHistory.append('<div class="outgoing_msg">' +
                                    '<div class="sent_msg">' +
                                    '<p>' + v.body +
                                    '</p>' +
                                    '<span class="time_date"> ' + time + ' | ' + month + '</span> </div>' +
                                    '</div>');
                            } else {
                                msgHistory.append('<div class="incoming_msg">' +
                                    '<div class="incoming_msg_img"> <img src="' + v.owner.user_image + '" alt="user-image"> </div>' +
                                    '<div class="received_msg">' +
                                    '<div class="received_withd_msg">' +
                                    '<p>' + v.body +
                                    '</p>' +
                                    '<span class="time_date">' + time + ' | ' + month + '</span></div>' +
                                    '</div>' +
                                    '</div>');
                            }
                        });
                        $(msgHistory).scrollTop(1000);
                    },beforeSend: function(){
                        var msgHistory = $('.msg_history');
                        msgHistory.empty();
                        $('.loader').show();
                    },
                    complete: function(){
                        $('.loader').hide();
                    }

                });
            }
            setTimeout(update,1000);


        });
        $('.msg_send_btn').click(function () {
            var user_id = $('.msg_send_btn').attr('data-user-id');
            var body = $('.write_msg').val();
            var data = {user_id,body};
            if(user_id) {
                $.ajax({
                    type: "POST",
                    url: '{{route('backend.send.messages')}}',
                    data: data,
                    success: function (data) {
                        if (data.status) {
                            var dt = new Date(data.message.created_at);
                            var time = moment(dt).format('HH:mm A');
                            var month = moment(dt).format("D MMMM");
                            var msgHistory = $('.msg_history');
                            msgHistory.append('<div class="outgoing_msg">' +
                                '<div class="sent_msg">' +
                                '<p>' + data.message.body +
                                '</p>' +
                                '<span class="time_date"> ' + time + ' | ' + month + '</span> </div>' +
                                '</div>');
                            $(msgHistory).scrollTop(msgHistory.scrollHeight);
                            $('.write_msg').val('');
                            $('#latest-'+user_id).text(data.message.body);

                        }
                    }
                });
            }
        });

    </script>
@endsection