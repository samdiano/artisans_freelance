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

                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <div class="badge part-badge">{!! $data->user->name !!}</div>
                                        </div><!-- end col -->

                                        <div class="col-md-2 col-sm-3 col-xs-12">
                                            <div class="job-meta text-center ">
                                                <a href="{{--route('chat.user', $data->code) --}}" class="pull-left messenger">
                                                    <i class="fab fa-facebook-messenger fa-2x"></i>
                                                </a>
                                                @php
                                                    $countMsg = App\Message::where('user_id',$data->user->id)->where('receiver_id',Auth::user()->id)->where('is_read',0)->count();
                                                @endphp

                                                @if($countMsg > 0)
                                                    <h4>{{$countMsg}}  new messages</h4>
                                                    @else
                                                    <h4>no  new messages</h4>
                                                @endif
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end job-tab -->
                            </div><!-- end alljobs -->
                        @endif
                    @endforeach

                        @else
                    <h3>You have no message yet!! </h3>
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
