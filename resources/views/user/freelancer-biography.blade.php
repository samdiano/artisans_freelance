@extends('user')
@section('css')
    <link href="{{asset('assets/front/css/biography.css')}}" rel="stylesheet">
    <link href="{{asset('assets/front/css/biography-user.css')}}" rel="stylesheet">
@stop
@section('content')
    <div class="section-background section-bottom-80" id="min-height-activity">
        <div class="parallax section parallax-off"
             style="@if($user->cover != null)
                     background-image:url({{asset('assets/images/user/'.$user->cover)}});
             @else
                     background-image:url({{asset('assets/images/logo/breadcrumb.jpg')}});
             @endif">
            <div class="container">
                <div class="page-title text-center">

                    @if(file_exists( 'assets/images/user/'.$user->image) && ($user->image != null))
                        <img src="{{asset('assets/images/user').'/'.$user->image}}" alt="Image"
                             class="profile-image img-circle img-responsive">
                    @endif

                    <div class="heading-holder">
                        <h1>{{$user->name}}</h1>
                    </div>
                    <p class="lead">{{$user->title}}</p>
                    <ul class="list-inline social-small">
                        @if($user->web != null)
                            <li><a href="{{$user->web}}"><i class="fa fa-link"></i></a></li>
                        @endif

                        @if($user->fb != null)
                            <li><a href="{{$user->fb}}"><i class="fa fa-facebook"></i></a></li>
                        @endif
                        @if($user->twitter != null)
                            <li><a href="{{$user->twitter}}"><i class="fa fa-twitter"></i></a></li>
                        @endif
                        @if($user->google_plus != null)
                            <li><a href="{{$user->google_plus}}"><i class="fa fa-google-plus"></i></a></li>
                        @endif
                        @if($user->linkedin != null)
                            <li><a href="{{$user->linkedin}}"><i class="fa fa-linkedin"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div><!-- end container -->
        </div><!-- end section -->

        @if($user->resume)
            <div class="section lb">
                <div class="container">
                    <div class="row">
                        <div class="content col-md-8 black">
                            <div class="panel panel-primary">
                                <div class="panel-heading panel-bio ">
                                    <h6>About {{ $user->name }}</h6>
                                </div>
                                <div class="panel-body">

                                    <p class="lead">@if($user->resume->skills != null)
                                            Skills: {{$user->resume->skills or ''}} @endif</p>
                                    <br>
                                    <div class="link-widget">
                                        <ul class="check ">
                                            <p>{!! $user->resume->resume_description or ' '!!}</p>
                                        </ul><!-- end check -->
                                    </div><!-- end link-widget -->
                                </div>
                            </div>

                        </div><!-- end col -->

                        <div class="sidebar col-md-4">


                            <div class="panel panel-primary">
                                <div class="panel-heading panel-bio ">
                                    <h6>Expected Charge Per Hour</h6>
                                </div>
                                <div class="panel-body">

                                    <div class="link-widget">
                                        <ul class="check ">
                                            <p>
                                                @if(($user->resume->minimum_salary != null) or  ($user->resume->maximum_salary != null))
                                                    <span class="text-center black">{{$user->resume->minimum_salary or ''}}
                                                        @if($user->resume->maximum_salary)
                                                            - {{$user->resume->maximum_salary or ''}} @endif {{$basic->currency_sym}} </span>
                                                @endif

                                            </p>
                                        </ul>
                                    </div><!-- end link-widget -->


                                </div>
                            </div>


                            @if($user->resume->institute != null)
                                <br><br>
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-bio ">
                                        <h6>Education</h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="link-widget">
                                            <ul class="check ">
                                                <p>{{ $user->resume->institute}}
                                                    , {{$user->resume->institute_duration}}</p>
                                                <p>{{$user->resume->institute_qualification}} </p>
                                                <p>{{$user->resume->institute_notes}} </p>
                                            </ul><!-- end check -->
                                        </div><!-- end link-widget -->
                                    </div>
                                </div>

                            @endif

                            @if($user->resume->institute != null)
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-bio ">
                                        <h6>Experience</h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="link-widget">
                                            <ul class="check ">
                                                <p>{{$user->resume->company_name}}</p>
                                                <p>{{$user->resume->position}}
                                                    , {{$user->resume->experience_duration}}</p>
                                                <p>{{$user->resume->experience_notes}}</p>
                                            </ul><!-- end check -->
                                        </div><!-- end link-widget -->
                                    </div>
                                </div>

                            @endif

                            <div class="widget post-padding clearfix">


                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end container -->
                </div><!-- end section -->
            </div>
    @endif
    <!-- Blog Single Section End -->

    </div>

    <div class="clearfix"></div>


    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 800);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 800);
            console.log(bodyHeight)
        }(jQuery))
    </script>
@stop