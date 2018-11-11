@extends('user')

@section('css')
    <link href="{{asset('assets/front/css/passed-job.css')}}" rel="stylesheet">
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
                    <div class="post-padding">
                        <div class="all-jobs job-listing active-jobs clearfix">
                            @if(count($projects) > 0)
                            @foreach($projects as $data)
                                <div class="job-tab">
                                    <div class="row">
                                        @php
                                            $img = 'assets/images/project/'.$data->project->image;
                                            $slug = str_slug($data->project->title);
                                        @endphp
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="post-media">
                                                <a href="{{route('details.job',[$data->project->id,$slug])}}">
                                                    @if(file_exists($img))
                                                        <img src="{{asset('assets/images/project/'.$data->project->image)}}"
                                                             alt="image" class="img-responsive img-thumbnail">
                                                    @else
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Project Thumbnail"
                                                             alt="image">
                                                    @endif
                                                </a>
                                            </div><!-- end media -->
                                        </div><!-- end col -->

                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <div class="badge freelancer-badge">{{$data->project->category->name or ''}}</div>
                                            <h3><a href="{{route('details.job',[$data->project->id,$slug])}}">{{$data->project->title or ''}}</a></h3>
                                            <small>
                                                @php
                                                    $biography = str_slug($data->project->user->name)
                                                @endphp
                                                <span>Client : <a href="{{route('biography',[$data->project->user->id, $biography])}}">{{$data->project->user->name}}</a></span>
                                                <span>End Date : {{$data->updated_at}}</span>
                                            </small>
                                        </div><!-- end col -->

                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <div class="job-meta text-center">
                                                <h4>{{$basic->currency_sym}} {{$data->amount}}</h4>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end job-tab -->
                            @endforeach
                                @else
                            <h3>You haven't any successfull job</h3>
                            @endif
                        </div><!-- end alljobs -->

                        {{$projects->links()}}
                    </div><!-- end post-padding -->
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
