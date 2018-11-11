@extends('admin.layout.master')

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">{{$page_title}}</span>
                    </div>
                    <div class="tools"></div>
                    <div class="actions">

                        <a href="{{route('testimonial.create')}}" class="btn btn-success btn-md pull-right ">
                            <i class="fa fa-plus"></i> Add New Testimonial
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th> Name</th>
                                <th>Details</th>
                                <th width="18%">ACTION</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($posts as $k=>$data)
                                <tr>
                                    <td data-label="SL">{{++$k}}</td>
                                    <td data-label="Name">{{$data->name or ''}}</td>
                                    <td data-label="Details">{{$data->details or ''}}</td>

                                    <td data-label="Action">
                                        <a href="{{route('testimonial.edit',$data->id)}}"
                                           class="btn btn-outline-primary btn-sm green ">
                                            <i class="fa fa-edit"></i> EDIT
                                        </a>


                                        <button type="button" class="btn btn-outline-danger red btn-sm delete_button"
                                                data-toggle="modal" data-target="#DelModal"
                                                data-id="{{ $data->id }}">
                                            <i class='fa fa-trash'></i> Delete
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $posts->render() !!}
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2"><i class='fa fa-trash'></i> Delete !</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <strong>Are you sure you want to Delete ?</strong>
            </div>

            <div class="modal-footer">
                <form method="post" action="{{ route('testimonial.delete') }}" class="form-inline">
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id" class="abir_id" value="0">

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No
                    </button>&nbsp;
                    <button type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Yes</button>
                </form>
            </div>

        </div>

    </div>





@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });
        });
    </script>
@endsection