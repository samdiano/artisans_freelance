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
                <div class="col-md-12 col-sm-12">
                    <aside>
                        @include('partials.profile')

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                {{$page_title}}
                            </div>
                        </div>

                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                <tr>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Freelancer</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($projects) > 0)
                                    @foreach($projects as $k=>$data)
                                        <tr id="tr" class="black">
                                            <td data-label="Job Title">
                                                @php $slug =  str_slug($data->project->title) @endphp
                                                <a href="{{route('details.job',[$data->project->id, $slug])}}">
                                                    <h6>{{$data->project->title}} </h6>
                                                </a>
                                                <br>
                                                <small class="black">Deadline : {{date('m.d.Y',strtotime($data->deadline))}}
                                                </small>
                                            </td>
                                            <td data-label="Freelancer">
                                                <a href="{{route('biography',[$data->user->id, $data->user->name])}}" class="black">
                                                    {{$data->user->name}}
                                                </a>
                                            </td>
                                            <td data-label="Action">

                                                @if($data->status == 0)

                                                    <a href="{{route('get.mileStone',[$data->id,$slug])}}" class="btn btn-info btn-sm" title="Create Milestone">
                                                        <i class="fas fa-donate"></i> <i></i>
                                                    </a>
                                                    <button data-toggle="modal" data-target="#small" value="3"
                                                            data-id="{{$data->id}}"
                                                            class="delete_button btn btn-danger btn-sm"
                                                            title="Remove">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
                            {!! $projects->links()!!}
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
    <div class="modal fade" role="dialog" id="small">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title"><i class="fa fa-trash"></i> Remove !</h6>
                </div>
                <div class="modal-body">
                    <p>Are you sure to remove from this user ?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('remove.assign.list')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="confirm_id">
                        <button type="submit" id="confirm_accept" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete_button', function () {
                var id = $(this).data('id');
                $('#confirm_id').val(id);
            });
        });

    </script>
@endsection
