@extends('frontend.layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>Online User</h2>
                <ul class="list-group" id="online-users">

                </ul>
            </div>
            <div class="col-md-8 d-flex flex-column" style="height: 80vh;">
                <div class="h-100 bg-white mb-4 p-5" id="chat" style="overflow-y: scroll">

                @foreach($messages as $message)
                    <div class="mt-4 w-50 text-white p-3 rounded {{ auth()->user()->id == $message->user_id ? 'float-right bg-primary' : 'float-left bg-warning'  }}">

                        <p>{{ $message->body }}</p>
                    </div>
                    <div class="clearfix"></div>
                    @endforeach
                </div>
                <form action="" class="d-flex">
                    <input type="text" name="" id="chat-text" data-url="{{route('frontend.message.store')}}" style="margin-right:10px" >
                    <button class="btn btn-primary">Send</button>
                </form>
            </div>

        </div>
    </div>
@endsection