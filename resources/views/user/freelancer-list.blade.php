@extends('user')
@section('css')
    <link href="{{asset('assets/front/css/job-list.css')}}" rel="stylesheet">
@stop
@section('content')

    @include('partials.breadcrumb')

    <section class="about-section section-padding-2 section-bg-clr1" id="min-height-joblist">
        <div class="container">
            <div class="all-jobs job-listing clearfix">
                @foreach($users as $data)
                    <div class="postlist-tab">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="post-meta">
                                    @php
                                        $img = 'assets/images/user/'.$data->image;
                                        $slug = str_slug($data->name);

                                        $biography = str_slug($data->name)
                                    @endphp
                                    <a href="{{route('biography',[$data->id, $biography])}}">
                                        @if($data->image != null)
                                            <img src="{{asset('assets/images/user/'.$data->image)}}" alt="image"
                                                 class="img-responsive img-thumbnail">
                                        @else
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text= Profile"
                                                 alt="image" class="img-responsive img-thumbnail">
                                        @endif
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="label  badge-highlight">{{$data->category->name or ' ' }}</div>
                                <h3><a href="{{route('biography',[$data->id, $biography])}}">{!! $data->name or '-' !!}</a>
                                </h3>
                                <small>
                                    @if($data->resume)
                                        <span class="span-color">Skills : {!! $data->resume->skills or '' !!}</span>
                                    @endif
                                </small>
                            </div><!-- end col -->

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="job-meta">
                                    <div class="margin-bottom-50"></div>
                                    <small>
                                        <span class="span-color"> Last Login : @if($data->userLogin['created_at'] != '') {{Carbon\Carbon::parse($data->userLogin['created_at'])->diffForHumans()}} @else Never @endif</span>
                                    </small>
                                </div><!-- end meta -->
                            </div><!-- end col -->

                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="job-meta text-center">
                                    @if($data->resume)
                                        <h4 class="salary"> {{$basic->currency_sym }} {{ $data->resume->minimum_salary or ''}} @if($data->resume->maximum_salary != null )
                                                - {{ $data->resume->maximum_salary or ''}} @endif</h4>
                                    @endif

                                    <a href="{{route('biography',[$data->id, $biography])}}"
                                       class="btn btn-primary btn-sm btn-block">View Profile</a>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end job-tab -->




                @endforeach
            </div><!-- end alljobs -->

            <div class="loadmore_button text-center clearfix">
                <a href="#" class="btn btn-primary" id="loadMore">See More Freelancer</a>
            </div><!-- end loadmore -->
        </div><!-- end container -->
    </section>
    <!-- About Hostonion End -->

    <div class="clearfix"></div>


    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-joblist').css('min-height', parseInt(bodyHeight) - 550);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-joblist').css('min-height', parseInt(bodyHeight) - 550);
            console.log(bodyHeight)

            /* ==============================================
                LOAD MORE
           =============================================== */

            $(function () {
                $(".postlist-tab").slice(0, 6).show();
                $("#loadMore").on('click', function (e) {
                    e.preventDefault();
                    $(".postlist-tab:hidden").slice(0, 4).slideDown();
                    if ($(".postlist-tab:hidden").length == 0) {
                        $("#load").fadeOut('slow');
                    }
                });
            });


        }(jQuery))
    </script>

@stop