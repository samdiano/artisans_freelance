@extends('user')
@section('css')
    <link href="{{asset('assets/front/css/job-list.css')}}" rel="stylesheet">
@stop
@section('content')
    <style type="text/css">
        .breadcrumb-section {
            background-image: url({{asset('assets/images/user/'.$project->user->cover)}});
        }
    </style>
    <!-- Breadcrumb Section start -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- breadcrumb Section Start -->
                    <div class="breadcrumb-content">
                        <h2>{{$project->user->name}}</h2>
                        <p>{{$project->user->company_tagline}}</p>
                    </div>
                    <!-- Breadcrumb section End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <div class="blog-section blog-section2 section-padding section-background" id="min-height-activity">
        <div class="container">
            <div class="single-job">
                <div class="job-tab">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="post-media">
                                <a href="{{asset('assets/images/project/'.$project->image)}}">
                                    @php
                                        $img = 'assets/images/project/'.$project->image;
                                        $slug = str_slug($project->title);
                                    @endphp
                                    @if(file_exists($img))
                                        <img src="{{asset('assets/images/project/'.$project->image)}}"
                                             alt="{{$project->title}}"
                                             class="img-responsive img-thumbnail">
                                    @else
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Project Thumbnail"
                                             alt="{{$project->title}}"
                                             class="img-responsive img-thumbnail">
                                    @endif
                                </a>
                            </div>
                            <br>
                        </div><!-- end col -->

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="badge freelancer-badge">{{$project->category_id}}</div>
                            <h3><a href="{{url()->current()}}">{{$project->title}}</a>
                            </h3>
                            <small>
                                @php
                                    $biography = str_slug($project->user->name)
                                @endphp
                                <span>Publisher : <a
                                            href="{{route('biography',[$project->user->id, $biography])}}">{{$project->user->name}}</a></span>
                                <span>Deadline : {{ date('d.m.Y', strtotime($project->deadline))}}</span>
                            </small>

                            <hr class="hr">

                            <p>Salary : {{$project->salary}} {{$basic->currency}} <span class="padding-l-50">Experience : {{$project->experience}}</span>
                            </p>

                            @if(Auth::user()->id != $project->user_id)
                                @if($project->deadline >= Carbon\Carbon::today())
                                    <a href="#contactmodal" role="button" data-toggle="modal"
                                       class="btn btn-primary btn-custom">Apple For Job</a>
                                @endif
                            @endif
                        </div><!-- end col -->

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="job-meta m45">
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-bio ">
                                        <h6>Company Information </h6>
                                    </div>
                                    <div class="panel-body">
                                        @php
                                            $img = 'assets/images/user/'.$project->user->image;
                                        @endphp
                                        @if(file_exists($img))
                                            <a href="{{route('biography',[$project->user->id, $biography])}}"><img
                                                        src="{{asset('assets/images/user/'.$project->user->image)}}"
                                                        alt="{{$project->user->name}}"
                                                        class="img-responsive img-circle w-40"></a>
                                        @else
                                            <a href="{{route('biography',[$project->user->id, $biography])}}"><img
                                                        src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Logo"
                                                        alt="image" class="img-responsive img-circle img-thumbnail"></a>
                                        @endif

                                        <ul class="company-links clearfix">
                                            @if($project->user->web != null)
                                                <li><a href="{{$project->user->web}}"><i class="fa fa-link"></i> Website</a>
                                                </li>
                                            @endif
                                            @if($project->user->google_plus != null)
                                                <li><a href="{{$project->user->google_plus}}"><i class="fa fa-google-plus"></i>
                                                        Google+</a></li>
                                            @endif
                                            @if($project->user->twitter != null)
                                                <li><a href="{{$project->user->twitter}}"><i class="fa fa-twitter"></i> Twitter</a>
                                                </li>
                                            @endif
                                            @if($project->user->fb != null)
                                                <li><a href="{{$project->user->fb}}"><i class="fa fa-facebook"></i> Facebook</a>
                                                </li>
                                            @endif
                                            @if($project->user->linkedin != null)
                                                <li><a href="{{$project->user->linkedin}}"><i class="fa fa-linkedin"></i>
                                                        Linkedin</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>


                            </div><!-- end meta -->
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end job-tab -->
            </div><!-- end single-job -->

            <br>

            <div class="row">
                <div class="content col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-bio ">
                            <h6>Job Details </h6>
                        </div>
                        <div class="panel-body">
                            {!! $project->description !!}
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- end container -->
    </div>

    <!-- Blog Single Section End -->

    <div class="clearfix"></div>



    <div class="modal fade" id="contactmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="bitUser(event)" name="bitForm"  id="submit" class="submit-form">
                    {{csrf_field()}}
                    <div class="row">
                <div class="modal-body">
                    <div class="widget clearfix">
                        <div class="post-padding item-price">
                            <div class="content-title">
                                <h4>Apply For : {{$project->title}} </h4>
                            </div><!-- end widget-title -->

                                    <div class="col-md-12 col-sm-12">
                                        <input type="hidden" name="project_id" value="{{$project->id}}" >
                                        <input type="hidden" name="author_id" value="{{$project->user_id}}" >
                                        <input type="text" name="offer" class="form-control" placeholder="What is your offer ? *">
                                        <p class="eml"></p>
                                        <textarea name="message" class="form-control"
                                                  placeholder="Say Something"></textarea>
                                        <p class="eml"></p>
                                    </div>
                                </div><!-- end row -->
                        </div><!-- end newsletter -->
                    </div><!-- end post-padding -->
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">APPLY JOB</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>
        function bitUser(e) {
            e.preventDefault();
            var form = document.getElementById('submit');
            var fd = new FormData(form);
            $.ajax({
                url: '{{route('bit.job')}}',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {
                    var em = document.getElementsByClassName("eml");
                    // after returning from the controller we are clearing the
                    // previous error messages...
                    for(i=0; i<em.length; i++) {
                        em[i].innerHTML = '';
                    }
                    if(data === "success") {
                        swal("Done!", "Bit Successfully.", "success");
                        $('#contactmodal').modal('hide');
                        document.forms["bitForm"].reset();
                    }
                    if (data == "no_success") {
                        swal("Opps!", "You are already Bit the job", "error");
                        $('#contactmodal').modal('hide');
                        document.forms["bitForm"].reset();
                    }
                    // Showing error messages in the HTML...
                    if(typeof data.error != 'undefined') {
                        if(typeof data.offer != 'undefined') {
                            em[0].innerHTML = data.offer[0];
                        }
                        if(typeof data.message != 'undefined') {
                            em[1].innerHTML = data.message[0];
                        }
                    }
                }
            });
        }
    </script>

    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 450);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 450);
            console.log(bodyHeight)
        }(jQuery))
    </script>

@stop