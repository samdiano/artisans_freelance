@extends('admin.layout.master')
@section('import-css')

@stop
@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> {{$page_title}}
            </h3>
            <hr>
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <div class="row">
                        <form role="form" method="POST" action="{{route('service-heading')}}" name="editForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-5 col-md-offset-1">
                                    <h3> Title</h3>
                                    <div class="input-group">
                                        <input type="text" value="{{$basic->service_title}}" class="form-control input-lg"
                                               name="service_title">
                                        <div class="input-group-addon"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($errors->has('service_title'))
                                        <div class="error">{{ $errors->first('service_title') }}</div>
                                    @endif

                                </div>

                                <div class="col-md-5 ">
                                    <h3> Sub Title</h3>
                                    <div class="input-group">
                                        <input type="text" value="{{$basic->service_sub_title}}" class="form-control input-lg"
                                               name="service_sub_title">
                                        <div class="input-group-addon"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($errors->has('service_sub_title'))
                                        <div class="error">{{ $errors->first('service_sub_title') }}</div>
                                    @endif

                                </div>

                                <div class="col-md-10 col-md-offset-1">
                                    <h3>Background Image</h3>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">

                                            <img src="{{ asset('assets/images/logo/how-it-work.jpg') }}"  alt="...">

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

                                <div class="col-md-10 col-md-offset-1 ">
                                    <button class="btn btn-primary btn-block btn-lg">Update </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <div class="row">
                        @foreach($service as $m)
                            <div class="col-md-4 text-center">
                                <div class="margin-top-40">
                                    <span class="font-size">{!! $m->icon !!}</span>
                                    <h2 class="bold">{{$m->title}}</h2>
                                    <p>
                                        {!! $m->details !!}
                                    </p>
                                    <a href="{{ route('service-edit',$m->id) }}"
                                       class="btn blue btn-block margin-top-20"><i class="fa fa-edit"></i> Edit </a>


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>


@stop

@section('script')

@stop