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
                    <div class="tools">

                        <button class="btn btn-outline btn-circle btn-sm green pull-right" data-toggle="modal"
                                data-target="#addModal">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column" >
                        <thead>
                        <tr>
                            <th> Name</th>
                            <th> Status</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $dep)
                            <tr>
                                <td>
                                    {{$dep->name or ''}}
                                </td>
                                <td>
                                    @if($dep->status == 1)
                                        <label class="label label-success"> Enable </label>
                                    @else
                                        <label class="label  label-danger">Disable </label>
                                    @endif
                                </td>

                                <td>
                                    <button class="btn btn-outline btn-circle btn-sm green" data-toggle="modal"
                                            data-target="#Modal{{$dep->id}}">
                                        <i class="fa fa-pencil"></i> Edit
                                    </button>
                                </td>
                            </tr>


                            <!-- Modal for Edit button -->
                            <div class="modal fade" id="Modal{{$dep->id}}" tabindex="-1" role="dialog">
                                <div class="modal-content">
                                    <form role="form" method="POST"
                                          action="{{route('category.update', $dep->id)}}"
                                          enctype="multipart/form-data" name="editForm">
                                        {{ csrf_field() }}
                                        {{method_field('put')}}

                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel"><b class="abir_act"></b>
                                            <i class="fa fa-pencil"></i> Edit Category
                                        </h4>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Name :</label>
                                            <input type="text" class="form-control" name="name" value="{{$dep->name}}" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="Status">Status :</label>
                                            <select name="status"  class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="1" @if($dep->status == 1) selected @endif>Enable</option>
                                                <option value="0" @if($dep->status == 0) selected @endif>Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                            <button type="submit" class="btn  btn-success ">Save
                                            </button>

                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                    </div>
                                    </form>

                                </div>
                            </div>

                        @endforeach
                        <tbody>
                    </table>
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for Edit button -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
        <div class="modal-content">
            <form role="form" method="POST"
                  action="{{route('category.save')}}"
                  enctype="multipart/form-data" name="editForm">
                @csrf

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-plus"></i> Add Category
                    </h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" class="form-control" name="name"  required>
                    </div>
                    <div class="form-group">
                        <label for="Status">Status :</label>
                        <select name="status"  class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="1" >Enable</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn  btn-success ">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>

@endsection