@extends('user')
@section('css')
    <link href="{{asset('assets/front/css/bid-joblist.css')}}" rel="stylesheet">
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
                    @if(count($messages) > 0)
                    @foreach($messages as $data)
                        @if($data->user_id != Auth::user()->id)
                            <div class="all-jobs job-listing freelancer-list nopadlist clearfix">
                                <div class="job-tab">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            @php
                                                $slug = str_slug($data->bitJob->project->title);
                                                $title_id = $data->bitJob->project->id;
                                            @endphp

                                            <div class="post-media">
                                                <a href="{{route('details.job',[$title_id,$slug])}}">
                                                    @if(file_exists( 'assets/images/project/'.$data->bitJob->project->image) && ($data->bitJob->project->image != null))
                                                        <img src="{{asset('assets/images/project').'/'.$data->bitJob->project->image}}"
                                                             alt="Image" class="img-responsive img-thumbnail">
                                                    @else
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Project Thumnail"
                                                             alt="Image" class="img-responsive img-thumbnail">
                                                    @endif
                                                </a>
                                            </div><!-- end media -->
                                        </div><!-- end col -->

                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <div class="badge part-badge">
                                                @if($data->bitJob->user->id == Auth::id())
                                                    {{$data->bitJob->author->name}}
                                                @elseif($data->bitJob->user->id != Auth::id())
                                                    {{$data->bitJob->user->name}}
                                                @endif
                                            </div>

                                            <div class="padding-top-20">
                                                <h3>
                                                    @php
                                                        $slug = str_slug($data->bitJob->project->title);
                                                        $title_id = $data->bitJob->project->id;
                                                    @endphp
                                                    <a href="{{route('details.job',[$title_id,$slug])}}">
                                                        {{$data->bitJob->project->title}}
                                                    </a>
                                                </h3>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="job-meta text-center ">
                                                <div class="margin-top-20"></div>
                                                <strong>Last Login : {{\Carbon\Carbon::parse($data->bitJob->user->userLogin->created_at)->diffForHumans()}}</strong>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-2 col-sm-3 col-xs-12">
                                            @php
                                                $user = Auth::id();
                                                    $chat =  App\Message::where('receiver_id',$user)->where('bit_job_id',$data->bit_job_id)->latest()->first();
                                            @endphp
                                            <div class="job-meta text-center ">
                                                <a href="{{route('chat.user',$data->bitJob->code)}}" class="pull-left messenger">
                                                    <i class="fab fa-facebook-messenger fa-2x"></i>
                                                </a>
                                                @php
                                                    $chat =  App\Message::where('receiver_id',$user)->where('is_read',0)->where('bit_job_id',$data->bit_job_id)->latest()->get();
                                                @endphp

                                                @if(count($chat) > 0)
                                                    <h6>{{count($chat)}}  new messages</h6>
                                                @endif
                                            </div>
                                        </div><!-- end col -->

                                    </div><!-- end row -->
                                </div><!-- end job-tab -->
                            </div><!-- end alljobs -->
                        @endif
                    @endforeach

                        @else
                        <div class="all-jobs job-listing freelancer-list nopadlist clearfix ">
                        <h3 class="text-center padding-tb-20">You have no message yet!! </h3>
                        </div>
                    @endif


                </div>
                <!--end left column-->

            </div>
        </div>
    </div>
    <!-- Blog Single Section End -->
    <div class="clearfix"></div>



@endsection
@section('js')
@endsection
