@extends('user')
@section('css')
    <link href="{{asset('assets/front/css/biography.css')}}" rel="stylesheet">
@stop
@section('content')
    <div class="section-bottom-80 section-background" id="min-height-activity">
        <div class="parallax section parallax-off"
             style="
             @if($user->cover != null)
                     background-image:url({{asset('assets/images/user/'.$user->cover)}});
             @else
                     background-image:url({{asset('assets/images/logo/breadcrumb.jpg')}});
             @endif
                     ">
            <div class="container">
                <div class="page-title text-center">
                    @if($user->image != null)
                        <img src="{{asset('assets/images/user/'.$user->image)}}" alt="{{$user->image}}"
                             class="profile-image img-circle img-responsive">
                    @endif
                    <div class="heading-holder">
                        <h1>{{$user->name}}</h1>
                    </div>
                    <p class="lead">{!! $user->company_tagline !!}</p>
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

        <div class="section lb">
            <div class="container">
                <div class="row">
                    <div class="content col-md-7">
                        <div class="panel panel-primary">
                            <div class="panel-heading panel-bio ">
                                <h6>About {{$user->name}}</h6>
                            </div>
                            <div class="panel-body">

                                <div class="link-widget">
                                    <ul class="check ">
                                        <p>{!! $user->company_description !!}</p>
                                    </ul><!-- end check -->
                                </div><!-- end link-widget -->
                            </div>
                        </div>

                    </div><!-- end col -->

                    <div class="sidebar col-md-5">
                        {{--<div class="widget post-padding  customwidget clearfix">--}}

                        <div class="panel panel-primary">
                            <div class="panel-heading panel-bio ">
                                <h6> {{$user->name}} Info</h6>
                            </div>
                            <div class="panel-body">


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Email</h4>
                                            <small>{{$user->email}}</small>
                                        </div><!-- end small -->
                                    </div><!-- end col -->
                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Phone</h4>
                                            <small>{{$user->phone}}</small>
                                        </div><!-- end small -->
                                    </div><!-- end col -->
                                </div>

                                <hr class="invis">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Company Type</h4>
                                            <small>{{$user->category->name or ''}}</small>
                                        </div><!-- end small -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Member Since</h4>
                                            <small>{{ date('F, Y', strtotime($user->created_at)) }}</small>
                                        </div><!-- end small -->
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div>
                        </div>

                        {{--</div>--}}

                        @php
                            $projects = \App\Project::where('user_id', $user->id)->where('approve',1)->latest()->take(3)->get();
                        @endphp

                        @if(count($projects)>0)
                            <div class="widget clearfix">
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-bio ">
                                        <h6>About Jobs From {{$user->name}}</h6>
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="table-responsive job-table">
                                                    <table id="mytable"
                                                           class="table table-striped table-bordered table-hover">

                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Job Title</th>
                                                            <th scope="col">Type</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($projects as $data)
                                                            @php
                                                                $slug = str_slug($data->title);
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <h4>
                                                                        <a href="{{route('details.job',[$data->id,$slug])}}"
                                                                           class="black">{{$data->title}}</a><br>
                                                                        <small>Deadline
                                                                            : {{ date('d.m.Y', strtotime($data->deadline)) }}</small>
                                                                    </h4>
                                                                </td>
                                                                <td data-label="Type">
                                                                    <a class="default-cursor black">{{$data->category->name}}</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div><!-- end table -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- end post-padding -->
                        @endif

                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end section -->

    </div>
    <!-- Blog Single Section End -->

    <div class="clearfix"></div>



    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 750);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 750);
            console.log(bodyHeight)
        }(jQuery))
    </script>
@stop