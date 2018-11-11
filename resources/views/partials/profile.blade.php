@php
    $user = Auth::id();
      $msg =  App\Message::where('receiver_id',$user)->where('is_read',0)->distinct()->get(['bit_job_id']);
@endphp

<div class="custom-menu list-group list-group-horizontal">

    <a href="{{route('user.messages')}}" class="list-group-item  @if(request()->path() == 'user/messages') active @endif "><span class="fab fa-facebook-messenger  padding-r-5"  @if(request()->path() != 'user/messages') style="color: #585756" @else  style="color: #fff" @endif ></span>  Messages @if(count($msg)>0) ({{$msg->count()}}) @endif</a>
    @if(Auth::user()->type ==1)
    <a href="{{route('edit.resume')}}" class="list-group-item"> + <span class="glyphicon glyphicon-user padding-r-5"></span> Edit Resume</a>
        @php
            $user = Auth::user();
                $newJob = App\AssignJob::where('user_id', $user->id)->whereStatus(0)->where('notify',0)->count();
        @endphp

        <a href="{{route('activeJobList')}}" class="list-group-item">
            <span class="glyphicon glyphicon-briefcase padding-r-5"></span>
            My Jobs @if($newJob>0)<span class="badge badge-info badge-button">{{$newJob}} new</span>@endif
        </a>
    @elseif(Auth::user()->type ==2)
        <a href="{{route('manage.job')}}" class="list-group-item  @if(request()->path() == 'user/manage-job') active @endif "><span class="glyphicon glyphicon-briefcase padding-r-5"></span>  Manage  Jobs</a>

        <a href="{{route('add.job')}}" class="list-group-item  @if(request()->path() == 'user/add-job') active @endif"><span class="glyphicon glyphicon-plus padding-r-5"></span>  Post New Job</a>
        <a href="{{route('assign.list')}}" class="list-group-item  @if(request()->path() == 'user/awarded-list') active @endif"><span class="glyphicon glyphicon-bookmark padding-r-5"></span> Job Awarded List</a>
        <a href="{{route('user.trx')}}" class="list-group-item  @if(request()->path() == 'user/transaction-log') active @endif"><span class="glyphicon glyphicon-edit padding-r-5"></span>  Transactions</a>
    @endif
</div>

