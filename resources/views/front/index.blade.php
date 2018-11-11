@extends('layout')
@section('css')
    <link href="{{asset('assets/front/css/homepage.css')}}" rel="stylesheet">
    <link href="{{asset('assets/front/css/highlaw.css')}}" rel="stylesheet">
    <link href="{{asset('assets/front/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/front/css/mirex.css')}}" rel="stylesheet">
    <link href="{{asset('assets/front/css/magnific-popup.css')}}" rel="stylesheet">
    <style>

        @php $i=0@endphp
                @foreach($sliders as $k=>$data)
        .header-area .carousel-thumb{{++$i}}  {
            background: url({{asset('assets/images/slider/'.$data->image)}});
            background-attachment: fixed;
            background-size: cover;
            background-position: center center;
            padding: 160px 0;
        }
        @endforeach
    </style>
@stop
@section('content')


    <!--Header section start-->
    <section id="particles-js" class="header-area">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->

            <div class="carousel-inner" role="listbox">
                @php $i=0@endphp
                @foreach($sliders as $k=>$data)
                    <div class="item @if($i ==0) active @endif carousel-thumb{{++$i}}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 text-center">
                                    <div class="header-section-wrapper">
                                        <div class="header-section-top-part">
                                            <h5>{{$data->title}}</h5>
                                            <h1>{{$data->sub_title}}</h1>
                                            <p>{!! $data->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Controls -->
            <a class="left carousel-control1" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control1" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!--Header section end-->
    <div class="clearfix"></div>

    <!-- Admin section start -->
    <div class="admin-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- admin content start -->
                    <div class="admin-content">
                        <!-- admin text start -->
                        <div class="admin-text">
                            <h2>Get access to Your account</h2>
                        </div>
                        <!-- admin text end -->
                        <!-- admin user start -->
                        <div class="admin-user">
                            <a href="{{route('login')}}">
                                <button class="button-hover" type="submit" name="login">sign in</button>
                            </a>
                            <a href="{{route('register')}}">
                                <button type="submit" name="register">register now</button>
                            </a>
                        </div>
                        <!-- admin user end -->
                    </div>
                    <!-- admin-content end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Admin section end -->
    <div class="clearfix"></div>



    <!-- about area start -->
    <section class="about-us-aera">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-offset-2 col-md-8 col-md-offset-2">
                    <div class="section-title text-center">
                        <h2 class="title text-uppercase"> <strong>{{$basic->about_heading}}</strong></h2>
                        <p class="description">{{$basic->about_sub_title}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="left-content-area"><!-- let content area -->
                        <div class="thumb">
                            <img src="{{asset('assets/images/logo/'.$basic->about_image)}}" alt="about left image">
                            <div class="hover">
                                <a href="{{$basic->video_link}}" class="mfp-iframe video-play-btn"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div><!-- //. left content area -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="right-content-area"><!-- right content area -->
                        {!! $basic->short_about_text !!}

                    </div><!-- //.right content area -->
                </div>
            </div>
        </div>
    </section>
    <!-- about area end -->


    <!-- our practise area start -->
    <section class="practise-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                    <div class="section-title text-center white">
                        <h2 class="title">
                            <strong>{{$basic->featured_title}}</strong>
                        </h2>
                        <p class="description white">{{$basic->featured_detail}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($features as $data)
                <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                    <div class="single-practise-box margin-bottom-40"><!-- single practise box -->
                        <div class="icon">
                            {!! $data->icon !!}
                        </div>
                        <div class="content">
                            <a ><h4 class="title">{{$data->title}}</h4></a>
                            <p>{{$data->details}}</p>
                        </div>
                    </div><!-- //. single practise box -->
                </div>
                    @endforeach
            </div>
        </div>
    </section>
    <!-- our practise area end -->



    <!-- how it work area start -->
    <section class="how-it-work how-it-work-bg ">

        <div class="container">
            <div class="how-it-work-progress ">
                <img src="{{asset('assets/images/how-it-work-vector.png')}}" class="cloud5" alt="how it work progress">
            </div>
            <div class="row text-center">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="section-title text-center">
                        <span class="subtitle">{{$basic->service_sub_title}}</span>
                        <h2 class="title">{{$basic->service_title}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $color = array('','two','three');
                @endphp
                @foreach($services as $k=>$data)
                <div class="col-lg-4 col-md-6">
                    <div class="single-how-it-work {{$color[$k]}} wow fadeInUp"><!-- single how it work -->
                        <div class="icon">
                            {!! $data->icon !!}
                        </div>
                        <div class="content">
                            <h4 class="title">{{$data->title}}</h4>
                            <p>{!! $data->details !!}</p>
                        </div>
                    </div><!-- //.single how it work -->
                </div>
                    @endforeach
            </div>
        </div>
    </section>
    <!-- how it work area end -->


    <section class="our-attorney-area"></section>


    <!-- counter and subscribe area start -->
    <section class="counter-and-subscribe-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                    <div class="single-counter-box"><!-- single counter box -->
                        <div class="bg-icon"><i class="pe-7s-users"></i></div>
                        <div class="counter-number">
                            <span class="count-numb">{{$freelancer}}</span>
                        </div>
                        <h4 class="name">Freelancer</h4>
                    </div><!-- //. single counter box -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                    <div class="single-counter-box rrmt-30">
                        <!-- single counter box -->
                        <div class="bg-icon two"><i class="pe-7s-users"></i></div>
                        <div class="counter-number">
                            <span class="count-numb">{{$employer}}</span>
                        </div>
                        <h4 class="name">Employer</h4>
                    </div>
                    <!-- //. single counter box -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                    <div class="single-counter-box rmt-30">
                        <!-- single counter box -->
                        <div class="bg-icon three"><i class="pe-7s-news-paper"></i></div>
                        <div class="counter-number">
                            <span class="count-numb">{{$jobs}}</span>
                        </div>
                        <h4 class="name">Jobs</h4>
                    </div>
                    <!-- //. single counter box -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="subscribe-outer-wrapper"><!-- subscribe form wrapper -->
                        <h2 class="title">Subscribe for more updates</h2>
                        <div class="subscribe-form-wrapper">
                            <form action="{{route('subscribe')}}" method="post">
                                @csrf
                                <div class="form-element">
                                    <input type="email" name="email" placeholder="Enter your email address" class="input-field">
                                </div>
                                <input type="submit" value="subscribe" class="submit-btn">
                            </form>
                        </div>
                    </div><!-- subscribe form wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- counter and subscribe area end -->




    <div class="clearfix"></div>


    <style>
        .owl-carousel .owl-item img {
            width: auto;
        }
        .single-testimonial-item {
            margin-bottom: 50px;
        }
    </style>

    <div class="parallax section overlay" data-stellar-background-ratio="0.5"
         style="background-image:url('assets/images/logo/testimonial.jpg'); background-position: 0px 66.4844px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme testimonials" id="testimonial-carousel">
                            @foreach($testimonials as $testimonial)
                                <div class="single-testimonial-item">
                                    <blockquote>
                                        <p class="clients-words">{!! $testimonial->details !!}</p>
                                        <span class="clients-name text-primary">— {{$testimonial->name}}</span>
                                        <img class="img-circle img-thumbnail"
                                             src="{{asset('assets/images/testimonial/'.$testimonial->image)}}"
                                             alt="{{$testimonial->name}}">
                                    </blockquote>
                                </div>
                            @endforeach
                    </div>
                </div><!--/.col-->
            </div><!--/.row-->
        </div><!-- end container -->
    </div><!-- end section -->




    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-home').css('min-height', parseInt(bodyHeight) - 550);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-home').css('min-height', parseInt(bodyHeight) - 550);
            console.log(bodyHeight)


        }(jQuery))
    </script>

@stop

@section('script')
    <script src="{{asset('assets/front/js/particles.min.js')}}"></script>
    <script src="{{asset('assets/front/js/custom-particles.js')}}"></script>
    <script src="{{asset('assets/front/js/TweenMax.js')}}"></script>
    <script src="{{asset('assets/front/js/mousemoveparallax.js')}}"></script>
@stop
@section('js')


    <script>
        $(document).ready(function() {
            $('.video-play-btn,.video-popup,.small-vide-play-btn').magnificPopup({
                type: 'video'
            });

            var owlTestimonial = $('#testimonial-carousel');
            owlTestimonial.owlCarousel({
                margin:30,
                loop:true,
                autoplay:true,
                autoplayTimeout:5000,
                autoplayHoverPause:true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    960: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    },
                    1920: {
                        items: 4
                    }
                }
            })
        })
    </script>
    @stop