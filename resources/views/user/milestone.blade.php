@extends('user')

@section('css')
@stop
@section('content')

    @include('partials.breadcrumb')

    <!-- Blog Single Section Start -->
    <div class=" section-padding section-background" id="min-height-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('errors.error')
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        @include('partials.profile')

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="pull-left title-responsive">{{$page_title}}
                                    For {{$project->project->title}}</span>

                            </div>

                            <button data-toggle="modal" data-target="#addMilestone" value="3"
                                    data-id="{{$project->id}}"
                                    data-user="{{$project->user_id}}"
                                    data-project="{{$project->project_id}}"
                                    class="addMilestone btn btn-success btn-sm pull-right margin-t-5">
                                <i class="fa fa-plus"></i> Create Milestone
                            </button>

                        </div>

                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 20%">Date</th>
                                    <th scope="col" style="width: 10%">Amount</th>
                                    <th scope="col" style="width: 30%">Details</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="width: 30%">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($project->mileStones->count() > 0)
                                    @foreach($project->mileStones as $k=>$data)
                                        <tr id="tr" class="black">
                                            <td data-label="Date" class="black">
                                                {{date('d F Y',strtotime($data->created_at))}}
                                            </td>
                                            <td data-label="Amount" class="black">
                                                {{number_format($data->amount,2)}} {{$basic->currency}}
                                            </td>
                                            <td data-label="Details" class="black">
                                                {!! $data->description !!}
                                            </td>
                                            <td data-label="Status">
                                                @if($data->status == 0)
                                                    <button class="btn btn-warning btn-sm "><i
                                                                class="fas fa-spinner"></i>
                                                        Pending
                                                    </button>
                                                @elseif($data->status == -1)
                                                    <button class="btn btn-danger btn-sm "><i
                                                                class="fas fa-times"></i>
                                                        Rejected
                                                    </button>
                                                @elseif($data->status == 1)
                                                    <button class="btn btn-primary btn-sm "><i
                                                                class="fa fa-money"></i>
                                                        Paid
                                                    </button>
                                                @endif


                                            </td>
                                            <td data-label="Action">

                                                @if($data->status == 0)


                                                    @php
                                                        $report = App\Report::where('milestone_id',$data->id)->count()
                                                    @endphp
                                                    @if($report>0)
                                                        <a href="{{route('report.log.author',$data->id)}}"
                                                           class=" btn btn-info btn-sm">
                                                            Report Log
                                                        </a>
                                                    @else
                                                        <button data-toggle="modal" data-target="#release_button"
                                                                value="3"
                                                                data-id="{{$data->id}}"
                                                                class="release_button btn btn-success btn-sm"> Release
                                                            Payment
                                                        </button>
                                                        <button data-toggle="modal" data-target="#report_button"
                                                                value="3"
                                                                data-id="{{$data->id}}"
                                                                class="report_button btn btn-danger btn-sm ">
                                                            Admin Help
                                                        </button>
                                                    @endif

                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="5">No Data Found!!</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!--end left column-->

            </div>
        </div>
    </div>
    <!-- Blog Single Section End -->
    <div class="clearfix"></div>



    <!-- Modal -->
    <div class="modal fade" role="dialog" id="release_button">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title"><i class="fas fa-hand-holding-usd"></i> Release Amount </h6>
                </div>
                <div class="modal-body">
                    <p>Are you want to release this Amount ?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('release.amount')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="confirm_id">
                        <button type="submit" id="confirm_accept" class="btn btn-success">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" role="dialog" id="addMilestone">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title"><i class="fa fa-plus"></i> Create Milestone </h6>
                </div>

                <form action="{{route('create.mileStone')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label class="label black"><strong>Amount : </strong></label>
                        <div class="input-group ">
                            <input type="text" name="amount" class="form-control" placeholder="Enter Amount"/>
                            <label class="input-group-addon">{{$basic->currency}} </label>
                        </div>
                        <br>
                        <label class="label black"><strong>Description :</strong> </label>
                        <div class="form-group ">
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder=" Enter your description"></textarea>
                        </div>

                        <input type="hidden" name="id" id="assign_jobs">
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="hidden" name="project_id" id="project_id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" role="dialog" id="report_button">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title"><i class="fas fa-file-invoice-dollar"></i> Report to Admin </h6>
                </div>

                <form action="{{route('user.report')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="Report" class="black">Your Complain : </label>
                        <textarea name="report" id="report" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="milestone_id" id="milestone_id">
                        <button type="submit" class="btn btn-success">Send</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.release_button', function () {
                var id = $(this).data('id');
                $('#confirm_id').val(id);
            });

            $(document).on('click', '.report_button', function () {
                var id = $(this).data('id');
                $('#milestone_id').val(id);
            });

            $(document).on('click', '.addMilestone', function () {
                var id = $(this).data('id');
                var userId = $(this).data('user');
                var projectId = $(this).data('project');
                $('#assign_jobs').val(id);
                $('#user_id').val(userId);
                $('#project_id').val(projectId);
            });

        });

    </script>
@endsection
