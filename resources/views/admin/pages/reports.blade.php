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
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column">
                        <thead>
                        <tr>
                            <th>Username </th>
                            <th>
                                Details
                            </th><th>
                                Details
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $dis_id = [];
                        @endphp
                        @foreach($reports as $dep)
                            @if(!in_array($dep->milestone_id, $dis_id))
                            <tr>
                                <td>
                                    <a href="{{route('user.single', $dep->user->id)}}">
                                    {{$dep->user->username}}
                                    </a>
                                </td>
                                <td>
                                    @if($dep->is_read == 0)
                                        <b>{!!  $dep->report!!}</b>
                                    @else
                                    {!!  $dep->report!!}
                                    @endif
                                </td>

                                <td>
                                    <a href="{{route('reports.view',$dep->milestone_id)}}" class="btn btn-outline btn-circle btn-sm green" >
                                        <i class="fa fa-eye"></i> view </a>
                                </td>
                            </tr>
                        @php
                            $dis_id[] = $dep->milestone_id;
                        @endphp
                        @endif
                        @endforeach
                        <tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>



@endsection

@section('script')
@stop

