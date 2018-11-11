<!--support bar  top start-->
<div class="support-bar-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-info">
                    <ul>
                        <li><i class="fa fa-envelope email" aria-hidden="true"></i> {{$basic->email}}</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{$basic->phone}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <div class="contact-admin__">
                    <div class="notification-wrapper">
                        @php
                            $user = Auth::id();
                            $msg =  App\Message::where('receiver_id',$user)->where('is_read',0)->distinct()->get(['bit_job_id']);
                        @endphp

                        <div class="single-notification-item">
                            <div class="icon">
                                <i class="fab fa-facebook-messenger messenger-white"></i>

                                @if($msg->count() > 0)<span class="badge__">{{$msg->count()}}</span> @endif
                            </div>
                            <div class="dropdown-notification">
                                <ul>
                                    @foreach($msg as $data)
                                        <li>
                                            @php
                                                $chat =  App\Message::where('receiver_id',$user)->where('is_read',0)->where('bit_job_id',$data->bit_job_id)->latest()->first();
                                            @endphp
                                            <a href="{{route('chat.user',$data->bitJob->code)}}">
                                                <div class="single-notification">
                                                    <h4 class="title">{{str_limit($chat->message,30) }}</h4>

                                                    <span class="textColor padding-tb-10 sent-from">Sent From : {{$chat->user->name}} </span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach

                                    <li>
                                        <a href="{{route('user.messages')}}" class="view_more_notification">
                                            <div class="single-notification">
                                                <i class="fa fa-caret-right"></i> View All
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        @php
                          $authUser = Auth::user();
                        $mileStones =  App\Milestone::where('user_id',$user)->where('status',0)->where('is_read',0)->get();
                        $mile_ids = \App\Milestone::where('user_id', Auth::id())->where('status', 0)->get();
                        $mile_ids_author = \App\Milestone::where('author_id', Auth::id())->where('status', 0)->get();

                        $ids = [];
                        foreach ($mile_ids as $id){
                        $ids[] = $id->id;
                        }

                        $idsAuthor = [];
                        foreach ($mile_ids_author as $id){
                        $idsAuthor[] = $id->id;
                        }


                        $report_count = \App\Report::whereIn('milestone_id', $ids)->where('read_type1',0)->get();
                        $report_author = \App\Report::whereIn('milestone_id', $idsAuthor)->where('read_type2',0)->get();
                        @endphp
                        @if($authUser->type == 1)
                            <div class="single-notification-item">
                                <div class="icon">
                                    <i class="fa fa-bell"></i>
                                    @if(count($mileStones)>0 || count($report_count)>0 )<span
                                            class="badge__">{{count($mileStones) + count($report_count)}}</span>@endif
                                </div>
                                <div class="dropdown-notification">
                                    <ul>
                                        @foreach($mileStones as $data)
                                            @php
                                                $slug =  str_slug($data->project->title);
                                            @endphp
                                            <li>
                                                <a href="{{route('projectMileStoneList',[$data->assign_job_id,$slug])}}">
                                                    <div class="single-notification">
                                                        <h4 class="title">
                                                            {{$data->amount}} {{$basic->currency}} added milestone from
                                                            {{$data->project->title}}
                                                        </h4>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach

                                        @foreach($report_count->take(8) as $data)
                                            <li>
                                                <a href="{{route('report.log',$data->milestone_id)}}">
                                                    <div class="single-notification">
                                                        <h4 class="title">
                                                            {{str_limit($data->report,50)}}
                                                        </h4>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>

                            </div>
                        @endif


                        @if($authUser->type == 2)
                            <div class="single-notification-item">
                                <div class="icon">
                                    <i class="fa fa-bell"></i>
                                    <span class="badge__">{{ count($report_author)}}</span>
                                </div>
                                <div class="dropdown-notification">
                                    <ul>

                                        @foreach($report_author->take(8) as $data)
                                            <li>
                                                <a href="{{route('report.log.author',$data->milestone_id)}}">
                                                    <div class="single-notification">
                                                        <h4 class="title">
                                                            {{str_limit($data->report,50)}}
                                                        </h4>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>

                            </div>
                        @endif

                        <div class="single-notification-item">
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="text__">
                                <span class="balance__">{{number_format(Auth::user()->balance, $basic->decimal)}} {{$basic->currency}}</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!--support bar  top end-->

