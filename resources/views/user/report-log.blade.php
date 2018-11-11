@extends('user')

@section('css')

    <link href="{{ asset('assets/front/css/report-chat.css') }}" rel="stylesheet">
@stop
@section('content')

    @include('partials.breadcrumb')

    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('errors.error')
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        @include('partials.profile')

                    </aside>
                </div>

                <div class="col-md-12 col-sm-12 ">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="pull-left">Conversation For: {{round($milestone->amount,2)}}  {{$basic->currency}}  </span><br>

                                <p class="project-title-chat">Project Title: {{$milestone->project->title}}</p>
                            </div>

                        </div>

                        <div class="portlet-body">
                            <div class="message-wrap ">
                                <div class="msg-wrap" id="messages">
                                    @foreach($reports as $data)
                                        <div class="media msg">
                                            <a class="pull-left" href="#">
                                                @if($data->report_from != 0)
                                                    @if($data->user->image != null)
                                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64"
                                                             style="width: 32px; height: 32px;"
                                                             src="{{asset('assets/images/user/'.$data->user->image)}}">
                                                    @else
                                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64"
                                                             style="width: 32px; height: 32px;"
                                                             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACqUlEQVR4Xu2Y60tiURTFl48STFJMwkQjUTDtixq+Av93P6iBJFTgg1JL8QWBGT4QfDX7gDIyNE3nEBO6D0Rh9+5z9rprr19dTa/XW2KHl4YFYAfwCHAG7HAGgkOQKcAUYAowBZgCO6wAY5AxyBhkDDIGdxgC/M8QY5AxyBhkDDIGGYM7rIAyBgeDAYrFIkajEYxGIwKBAA4PDzckpd+322243W54PJ5P5f6Omh9tqiTAfD5HNpuFVqvFyckJms0m9vf3EY/H1/u9vb0hn89jsVj8kwDfUfNviisJ8PLygru7O4TDYVgsFtDh9Xo9NBrNes9cLgeTybThgKenJ1SrVXGf1WoVDup2u4jFYhiPx1I1P7XVBxcoCVCr1UBfTqcTrVYLe3t7OD8/x/HxsdiOPqNGo9Eo0un02gHkBhJmuVzC7/fj5uYGXq8XZ2dnop5Mzf8iwMPDAxqNBmw2GxwOBx4fHzGdTpFMJkVzNB7UGAmSSqU2RoDmnETQ6XQiOyKRiHCOSk0ZEZQcUKlU8Pz8LA5vNptRr9eFCJQBFHq//szG5eWlGA1ywOnpqQhBapoWPfl+vw+fzweXyyU+U635VRGUBOh0OigUCggGg8IFK/teXV3h/v4ew+Hwj/OQU4gUq/w4ODgQrkkkEmKEVGp+tXm6XkkAOngmk4HBYBAjQA6gEKRmyOL05GnR99vbW9jtdjEGdP319bUIR8oA+pnG5OLiQoghU5OElFlKAtCGr6+vKJfLmEwm64aosd/XbDbbyIBSqSSeNKU+HXzlnFAohKOjI6maMs0rO0B20590n7IDflIzMmdhAfiNEL8R4jdC/EZIJj235R6mAFOAKcAUYApsS6LL9MEUYAowBZgCTAGZ9NyWe5gCTAGmAFOAKbAtiS7TB1Ng1ynwDkxRe58vH3FfAAAAAElFTkSuQmCC">
                                                    @endif

                                                @else
                                                    <img class="media-object" data-src="holder.js/64x64" alt="64x64"
                                                         style="width: 32px; height: 32px;"
                                                         src="{{asset('assets/images/logo/favicon.png')}}">
                                                @endif
                                            </a>
                                            <div class="media-body">
                                                <small class="pull-right time"><i class="fa fa-clock-o"></i>
                                                    {{$data->created_at}}
                                                </small>

                                                <h6 class="media-heading">{{$data->user->username or 'Admin'}}</h6>
                                                <small class="col-lg-10">{{ $data->report}}
                                                </small>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach


                                </div>

                                @if($milestone->status  ==0)
                                    <form action="{{route('send.reports')}}" method="post">
                                        @csrf
                                        <div class="send-wrap ">
                                            <input type="hidden" name="milestone_id" value="{{$milestone->id}}">
                                            <input type="hidden" name="report_against"
                                                   value="{{$milestone->author_id}}">
                                            <input type="hidden" name="amount" value="{{$milestone->amount}}">
                                            <textarea name="report" class="form-control send-message" rows="3" cols="10" placeholder="Write a reply..."></textarea>
                                        </div>
                                        <button type="submit" class=" btn  send-message-btn  btn-info "
                                                role="button">Send
                                        </button>

                                    </form>
                                @endif

                            </div>


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
        $(document).ready(function () {
            var elem = document.getElementById('messages');
            elem.scrollTop = elem.scrollHeight;
        })
    </script>
@endsection
