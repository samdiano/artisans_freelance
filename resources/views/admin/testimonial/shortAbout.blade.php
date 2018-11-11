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
                </div>
                <div class="portlet-body">
                    <form role="form" method="POST" action="" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 ">
                                <h3>Title</h3>
                                <div class="input-group">
                                    <input type="text" value="{{$basic->about_heading}}" class="form-control input-lg"
                                           name="about_heading">
                                    <div class="input-group-addon"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('about_heading'))
                                    <div class="error">{{ $errors->first('about_heading') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 ">
                                <h3>Sub-Title</h3>
                                <div class="input-group">
                                    <input type="text" value="{{$basic->about_sub_title}}" class="form-control input-lg"
                                           name="about_sub_title">
                                    <div class="input-group-addon"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('	about_sub_title'))
                                    <div class="error">{{ $errors->first('about_sub_title') }}</div>
                                @endif
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <h3>Video Thumbnail</h3>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        @if($basic->about_image == null)
                                            <img style="width: 200px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Image" alt="...">
                                        @else
                                            <img style="width: 120px" src="{{ asset('assets/images/logo') }}/{{ $basic->about_image }}" alt="...">
                                        @endif
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="about_image" accept="image/*" >
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('about_image'))
                                    <div class="error">{{ $errors->first('about_image') }}</div>
                                @endif

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 ">
                                <h3>Video Link</h3>
                                <div class="input-group">
                                    <input type="text" value="{{$basic->video_link}}" class="form-control input-lg"
                                           name="video_link">
                                    <div class="input-group-addon"><span class="input-group-text">
                                            <i class="fa fa-video"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('video_link'))
                                    <div class="error">{{ $errors->first('video_link') }}</div>
                                @endif
                            </div>
                        </div>
                        <br>


                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <h3>Details</h3>
                                <textarea name="short_about_text" id="area1" cols="30" rows="15" class="form-control">{{$basic->short_about_text}}</textarea>
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
    <script src="{{asset('assets/admin/js/nicEdit-latest.js')}}"></script>

    <script>
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>
@stop