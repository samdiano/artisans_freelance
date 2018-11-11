@extends('user')

@section('css')
    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #30336b;
        }

        .chat li.left .chat-body {
            margin-left: 60px;
        }

        .chat li.right .chat-body {
            margin-right: 60px;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon {
            margin-right: 5px;
        }

        .panel-body {
            overflow-y: scroll;
            height: 500px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }

    </style>

@stop
@section('content')

    @include('partials.breadcrumb')

    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        @include('partials.profile')
                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="panel panel-primary" id="app">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-comment"></span> {{$receiver_name}}
                        </div>
                        <div class="panel-body" id="messages">
                            <ul class="chat" id="message_append_body">

                                @foreach($messages as $data)
                                    <li class="@if(Auth::user()->id == $data->user_id) right  @else left @endif  clearfix chat-length messages"
                                        data-length="{{ $data->id }}">
                                    <span class="chat-img @if(Auth::user()->id == $data->user_id) pull-right @else pull-left @endif  ">

                                        @if(Auth::user()->id == $data->user_id)
                                            @php $string = $data->user->username @endphp
                                            <img src="http://placehold.it/50/FA6F57/fff&text={{strtoupper($string[0])}}"
                                                 alt="User Avatar"
                                                 class="img-circle"/>
                                        @else
                                            @php $string = $data->user->username @endphp
                                            <img src="http://placehold.it/50/55C1E7/fff&text={{strtoupper($string[0])}}"
                                                 alt="User Avatar"
                                                 class="img-circle"/>
                                        @endif
                                    </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                @if(Auth::user()->id == $data->user_id)
                                                    <small class="text-muted">
                                                        <span class="glyphicon glyphicon-time"></span>{{$data->created_at}}
                                                    </small>
                                                    <strong class="pull-right primary-font">{{$data->user->username}}</strong>
                                                @else
                                                    <strong class="primary-font">{{$data->user->username}}</strong>
                                                    <small class="pull-right text-muted">
                                                        <span class="glyphicon glyphicon-time"></span>{{$data->created_at}}
                                                    </small>
                                                @endif
                                            </div>
                                            <p>{!! $data->message !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                        <div class="panel-footer">
                            <form id="sendMessage" onsubmit="sendMessage(event)">
                                {{csrf_field()}}
                                <div class="input-group">
                                    <input type="hidden" name="receiver_id" id="receiver_id" value="{{$receiver_id}}">
                                    <input type="hidden" name="project_id" id="project_id" value="{{$project_id}}">
                                    <input type="hidden" name="betjob_id" id="betjob_id" value="{{$betjob_id}}">
                                    <input id="btn-input" type="text" name="message" class="form-control input-sm"
                                           placeholder="Type your message here..." autocomplete="off"/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-sm" id="btn-chat">
                                            Send
                                        </button>
                                    </span>
                                </div>
                                <p class="eml"></p>
                            </form>
                        </div>
                    </div>

                </div>
                <!--end left column-->
            </div>
        </div>
    </div>
    <!-- Blog Single Section End -->
    <div class="clearfix"></div>

@endsection
@section('js')

    <script>
        function sendMessage(e) {
            e.preventDefault();
            var form = document.getElementById('sendMessage');
            var fd = new FormData(form);
            console.log(fd)
            $.ajax({
                url: '{{route('store.message')}}',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('.input-sm').val('');
                }
            });
        }

        $(document).ready(function () {
            setInterval(function () {
                var length = $('.chat').find('.chat-length:last').data('length');
                if (typeof length === "undefined") {
                    length = 0;
                }
                var user = "{{ Auth::id() }}";
                var receiver = $('#receiver_id').val();
                var project = $('#project_id').val();
                var betjob_id = $('#betjob_id').val();
                $.ajax({
                    url: '{{ route('get.chat') }}',
                    type: 'post',
                    data: {length: length, user: user, receiver: receiver, project: project, betjob_id: betjob_id},
                    success: function (data) {
                        $.each(data, function (key, val) {
                            var auth = "{{Auth::user()->username}}";
                            var newSender = val.user.username;
                            var name = (val.user_id == user) ? auth.substr(0, 1) : newSender.substr(0, 1);
                            if (user == val.user_id) {
                                var html = '<li class="right clearfix chat-length" data-length="' + val.id + '"><span class="chat-img pull-right">\n' +
                                    '                            <img src="http://placehold.it/50/FA6F57/fff&text=' + name.toUpperCase() + '" alt="User Avatar" class="img-circle" />\n' +
                                    '                        </span>\n' +
                                    '                            <div class="chat-body clearfix">\n' +
                                    '                                <div class="header">\n' +
                                    '                                    <small class=" text-muted"><span class=" glyphicon glyphicon-time"></span>' + val.created_at + '</small>' +
                                    '                                   <strong class="pull-right  primary-font">' + auth + '</strong>' +
                                    '                               </div>\n' +
                                    '                                <p>\n' + val.message +
                                    '                                </p>\n' +
                                    '                            </div>\n' +
                                    '                        </li>'
                            } else {
                                var html = '<li class="left clearfix chat-length" data-length="' + val.id + '"><span class="chat-img pull-left">\n' +
                                    '                            <img src="http://placehold.it/50/55C1E7/fff&text=' + name.toUpperCase() + '" alt="User Avatar" class="img-circle" />\n' +
                                    '                        </span>\n' +
                                    '                            <div class="chat-body clearfix">\n' +
                                    '                                <div class="header">\n' +
                                    '                                    <strong class="primary-font">' + newSender + '</strong>' +
                                    '                                       <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>' + val.created_at + '</small>\n' +
                                    '                                </div>\n' +
                                    '                                <p>\n' + val.message +
                                    '                                </p>\n' +
                                    '                            </div>\n' +
                                    '                        </li>'
                            }
                            $('#message_append_body').append(html).ready(function () {
                                var elem = document.getElementById('messages');
                                elem.scrollTop = elem.scrollHeight;
                            });

                        });
                    }
                });
            }, 2000)
        });


        $(document).ready(function () {
            var elem = document.getElementById('messages');
            elem.scrollTop = elem.scrollHeight;
        })
    </script>

@endsection
