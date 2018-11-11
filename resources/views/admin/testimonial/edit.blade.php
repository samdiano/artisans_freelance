@extends('admin.layout.master')
@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
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
                        <a href="{{route('admin.testimonial')}}" class="btn btn-success btn-md pull-right ">
                            <i class="fa fa-eye"></i> All Testimonial
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form role="form" method="POST" action="{{route('testimonial.update')}}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 ">
                                <h6> Name</h6>
                                <div class="input-group">
                                    <input type="text" value="{{$post->name}}" class="form-control input-lg"
                                           name="name">
                                    <div class="input-group-addon"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif

                            </div>
                        </div>
                        <br>


                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <h6>Image</h6>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        @if($post->image == null)
                                            <img style="width: 200px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Client Image" alt="...">
                                        @else
                                            <img style="width: 120px" src="{{ asset('assets/images/testimonial') }}/{{ $post->image }}" alt="...">
                                        @endif
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*" >
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif

                            </div>
                        </div>

                        <br>



                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <h6>Details</h6>
                                <textarea name="details" id="area1" cols="30" rows="6" class="form-control">{{$post->details}}</textarea>
                            </div>
                        </div>
                        <br>

                        <div class="row">

                            <div class="col-md-10 col-md-offset-1 ">
                                <button class="btn btn-primary btn-block btn-lg">Update </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


@endsection

@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop
@section('script')
@stop