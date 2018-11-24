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
                    @foreach($bitJobs as $data)
                        <div class="all-jobs job-listing freelancer-list nopadlist clearfix">
                            <div class="job-tab">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <div class="post-media">
                                            <a href="{{route('biography',[$data->user->id, $data->user->username])}}">
                                                @if(file_exists( 'assets/images/user/'.$data->user->image) && ($data->user->image != null))
                                                    <img src="{{asset('assets/images/user').'/'.$data->user->image}}"
                                                         alt="Image" class="img-responsive img-thumbnail">
                                                @else
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Profile"
                                                         alt="Image" class="img-responsive img-thumbnail">
                                                @endif
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <div class="badge part-badge">{{$data->user->category_id or ''}}</div>
                                        <h3 class="post-tile"><a
                                                    href="{{route('biography',[$data->user->id, $data->user->username])}}">{{$data->user->name}}</a>
                                        </h3>
                                        <small>
                                            <span> @if($data->user->resume) Skills
                                                : {{ $data->user->resume->skills or ''}} @endif
                                            </span>
                                        </small>
                                    </div><!-- end col -->

                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="margin-top-40"></div>
                                        <small>
                                            <span>
                                                Last Login : {{Carbon\Carbon::parse($data->user->userLogin->created_at)->diffForHumans()}}
                                            </span>
                                        </small>
                                    </div><!-- end col -->


                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                        <div class="job-meta text-center ">
                                            <a href="{{route('chat.user',[$data->code])}}"
                                               class="pull-left messenger">
                                                <i class="fab fa-facebook-messenger font-20"></i>
                                            </a>
                                            <h4>{{$basic->currency_sym}} {{$data->offer}}</h4>


                                            @php
                                                $assign = \App\AssignJob::where('user_id',$data->user->id)->where('project_id',$data->project->id)->count();
                                            @endphp
                                            @if($assign>0)

                                                <button type="submit" class="btn btn-success btn-sm btn-block">
                                                    Awarded
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-primary btn-sm btn-block"
                                                        data-toggle="modal"
                                                        data-target="#Modal{{$data->id}}">
                                                    Give Job
                                                </button>
                                            @endif

                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end job-tab -->
                        </div><!-- end alljobs -->



                        <!-- Modal for Edit button -->
                        <div class="modal fade" id="Modal{{$data->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h6 class="modal-title" id="myModalLabel"><b
                                                    class="abir_act"></b> {{$data->project->title}} </h6>
                                    </div>

                                    <div class="modal-body">
                                        <p>Are you sure assign the job this user ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form role="form" method="POST"
                                              action="{{route('assign.job')}}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{method_field('post')}}
                                            <input type="hidden" name="project_id" value="{{$data->project->id}}">
                                            <input type="hidden" name="user_id" value="{{ $data->user->id}}">
                                            <input type="hidden" name="deadline" value="{{ $data->project->deadline}}">

                                            <button type="submit" class="btn  btn-primary ">Yes</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                    {!! $bitJobs->links() !!}

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
