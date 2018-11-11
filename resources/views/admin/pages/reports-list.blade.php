@extends('admin.layout.master')

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> {{$page_title}}
            </h3>
            <hr>
            @include('errors.error')
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">{{$page_title}}</span>
                    </div>
                    <div class="tools">
                        @php $user_id = []; @endphp
                        @foreach($reports as $data)
                            @if(!in_array($data->report_from, $user_id))
                                @if($data->report_from !=0)
                                    <button class="milestone_button btn btn-outline btn-circle btn-sm green pull-right margin-right-10"
                                            data-id="{{$milestone_id}}"
                                            data-user="{{$data->user->id}}"
                                            data-toggle="modal" data-target="#payButton"
                                    >
                                        <i class="fa fa-user"></i> {{$data->user->name}}
                                    </button>
                                    @php $user_id[] = $data->report_from; @endphp
                                @endif
                            @endif
                        @endforeach


                    </div>
                </div>
                <div class="portlet-body">
                    <div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0"
                         data-handle-color="#D7DCE2"  id="messages">
                        <div class="general-item-list">
                            @foreach($reports as $data)
                                <div class="item">
                                    <div class="item-head">
                                        <div class="item-details">
                                            @if($data->report_from!=0)
                                                <img class="item-pic rounded"
                                                     src="{{asset('assets/images/user/'.$data->user->image)}}">
                                                <a href="{{route('user.single', $data->user->id)}}"
                                                   class="item-name primary-link">{{$data->user->name}}</a>
                                            @else
                                                <img class="item-pic rounded"
                                                     src="{{asset('assets/images/logo/favicon.png')}}">
                                                <a href="#" class="item-name primary-link">ADMIN</a>
                                            @endif
                                            <span class="item-label">{{$data->created_at}}</span>
                                        </div>
                                    </div>
                                    <div class="item-body"> {!! $data->report !!}</div>
                                </div>
                            @endforeach


                            <form action="{{route('store.report')}}" method="post" class="form-horizontal">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="report"  class="form-control input-lg">
                                    <input type="hidden" name="milestone_id"  value="{{$milestone_id}}">
                                    <input type="hidden" name="report_from"  value="0">
                                    <input type="hidden" name="report_against"  value="0">
                                    <span class="input-group-addon">
                                            <button type="submit" class="btn btn-danger btn-sm">Send</button>
                                    </span>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="modal fade editModal" id="payButton" tabindex="-1"
         role="dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="btn btn-default btn-xs pull-right"
                        data-dismiss="modal">X
                </button>
                <h4 class="modal-title"><strong>Confirm Milestone Request</strong></h4>
            </div>
            <form method="post" action="{{route('milestone.accepted')}}">
                @csrf
                <div class="modal-body">
                    <strong>Are you sure to added balance this user??</strong>
                    <input type="hidden" name="milestone_id" id="milestone_id">
                    <input type="hidden" name="user_id" id="user_id">

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                </div>

            </form>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', '.milestone_button', function () {
            var id = $(this).data('id');
            var userId = $(this).data('user');
            $('#milestone_id').val(id);
            $('#user_id').val(userId);
        });

        $(document).ready(function () {
            var elem = document.getElementById('messages');
            elem.scrollTop = elem.scrollHeight;
        })
    </script>
@stop

