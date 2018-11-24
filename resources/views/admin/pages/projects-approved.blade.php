@extends('admin.layout.master')

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> {{$page_title}}

            </h3>
            <hr>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">{{$page_title}}</span>
                    </div>
                    <div class="tools"></div>
                    <div class="actions">
                        <form method="POST" class="form-inline" action="{{route('search.allApprove.projects')}}">
                            @csrf
                            <input type="text" name="search" class="form-control" placeholder="Search">
                            <button class="btn btn-outline btn-circle btn-sm green" type="submit"><i
                                        class="fa fa-search"></i></button>

                        </form>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Posted By</th>
                            <th>Deadline</th>
                            <th>
                                Details
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $dep)
                            <tr>
                                <td>{{$dep->title or  ''}}</td>
                                <td>{{$dep->category_id or ''}}</td>
                                <td>
                                    <a href="{{route('user.single', $dep->user->id)}}">
                                        {{$dep->user->username or ''}}
                                    </a>
                                </td>
                                <td>{{date(' d F, Y ', strtotime($dep->deadline))}}</td>

                                <td>
                                    <button class="btn btn-outline btn-circle btn-sm green" data-toggle="modal"
                                       data-target="#Modal{{$dep->id}}">
                                        <i class="fa fa-eye"></i> Details </button>
                                </td>
                            </tr>


                            <!-- Modal for Edit button -->
                            <div class="modal fade" id="Modal{{$dep->id}}" tabindex="-1" role="dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel"><b class="abir_act"></b> {!! $dep->title !!}
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Thumbnail :
                                                <img src="{{asset('assets/images/project/'.$dep->image)}}" alt="" class="img-responsive">
                                            </li>
                                            <li class="list-group-item">Salary : <strong>{{$dep->salary or '-'}} {{$basic->currency}}</strong></li>
                                            <li class="list-group-item">Deadline : <strong>{{date('d F, Y', strtotime($dep->deadline)) }} </strong></li>

                                            <li class="list-group-item">Experience : <strong>{{$dep->experience or '-'}}</strong></li>

                                            <li class="list-group-item">Description : <br>
                                                <p>{!!  $dep->description or '-'!!}</p></li>
                                            <li class="list-group-item">keywords : <strong>{{$dep->keywords or '-'}}</strong></li>

                                        </ul>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        <tbody>
                    </table>

                    {!! $projects->links() !!}
                </div>
            </div>

        </div>
    </div>



@endsection

@section('script')
@stop

