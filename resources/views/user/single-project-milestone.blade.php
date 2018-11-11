@extends('user')

@section('css')
@stop
@section('content')

    @include('partials.breadcrumb')

    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
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
                                <span class="pull-left">{{$page_title}} For : {{$project->project->title}} </span>
                            </div>

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
                                        <tr id="tr ">
                                            <td data-label="Date " class="black">
                                                {{date('d-m-Y',strtotime($data->created_at))}}
                                            </td>
                                            <td data-label="Amount" class="black">
                                                {{number_format($data->amount,2)}} {{$basic->currency}}
                                            </td>
                                            <td data-label="Details" class="black">
                                                {!! $data->description !!}
                                            </td>
                                            <td data-label="Status" class="black">
                                                @if($data->status == 0)
                                                    <button class="btn btn-warning btn-sm "><i
                                                                class="fas fa-spinner"></i>
                                                        Pending
                                                    </button>
                                                @elseif($data->status == -1)
                                                    <button class="btn btn-danger btn-sm "><i
                                                                class="fa fa-times"></i>
                                                        Rejected
                                                    </button>
                                                @elseif($data->status == 1)
                                                    <button class="btn btn-success btn-sm "><i
                                                                class="fa fa-check"></i>
                                                        Confirmed
                                                    </button>
                                                @endif


                                            </td>

                                            <td data-label="Action" class="black">

                                                @if($data->status == 0)


                                                    @php
                                                        $report = App\Report::where('milestone_id',$data->id)->count()
                                                    @endphp
                                                    @if($report>0)
                                                        <a href="{{route('report.log',$data->id)}}"
                                                           class=" btn btn-info btn-sm">
                                                            Report Log
                                                        </a>
                                                    @else
                                                        <button data-toggle="modal" data-target="#reject_button"
                                                                value="3"
                                                                data-id="{{$data->id}}"
                                                                class="reject_button btn btn-success btn-sm">
                                                            Reject Payment
                                                        </button>
                                                        <button data-toggle="modal" data-target="#report_button"
                                                                value="3"
                                                                data-id="{{$data->id}}"
                                                                class="report_button btn btn-danger btn-sm">
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
    <div class="modal fade" role="dialog" id="reject_button">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title"><i class="fas fa-donate"></i> Rejected Amount </h6>
                </div>
                <div class="modal-body">
                    <p>Are you want to reject this Amount ?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('reject.amount')}}" method="post">
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
            $(document).on('click', '.reject_button', function () {
                var id = $(this).data('id');
                $('#confirm_id').val(id);
            });

            $(document).on('click', '.report_button', function () {
                var id = $(this).data('id');
                $('#milestone_id').val(id);
            });

        });

    </script>
@endsection
