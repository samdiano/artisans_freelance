@extends('admin.layout.master')
@section('import-css')

@stop
@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="page-title uppercase bold"> {{$page_title}}</h3>
            <hr>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark pull-right">
                        <a href="{{route('featured.create')}}" class="btn btn-primary">
                        <span class="caption-subject bold uppercase ">
                            <i class="fa fa-plus"></i> Crate New
                        </span>
                        </a>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <form role="form" method="POST" action="{{route('service-heading')}}" name="editForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <h3> Title</h3>
                                    <div class="input-group">
                                        <input type="text" value="{{$basic->featured_title}}" class="form-control input-lg"
                                               name="featured_title">
                                        <div class="input-group-addon"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($errors->has('featured_title'))
                                        <div class="error">{{ $errors->first('featured_title') }}</div>
                                    @endif

                                </div>

                                <div class="col-md-10 col-md-offset-1">
                                    <h3> Details </h3>
                                    <div class="form-group">
                                        <textarea name="featured_detail" class="form-control input-lg" cols="30" rows="5">{{$basic->featured_detail}}</textarea>
                                    </div>
                                    @if ($errors->has('featured_detail'))
                                        <div class="error">{{ $errors->first('featured_detail') }}</div>
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
                                    <a href="{{ route('featured.edit',$m->id) }}" class="btn blue  margin-top-20"><i class="fa fa-edit"></i> Edit </a>
                                    <button class="btn blue red  margin-top-20" data-toggle="modal" data-target="#Modal{{$m->id}}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <hr>
                            </div>

                            <!-- Modal for Edit button -->
                            <div class="modal fade" id="Modal{{$m->id}}" tabindex="-1" role="dialog">
                                <div class="modal-content">
                                    <form role="form" method="POST"
                                          action="{{route('featured.delete')}}"
                                          enctype="multipart/form-data" name="editForm">
                                        {{csrf_field()}}

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel"><b class="abir_act"></b>
                                                <i class="fa fa-trash"></i> Delete
                                            </h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure to delete this ??
                                                <input type="hidden" class="form-control" name="id" value="{{$m->id}}" >

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn  btn-success ">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>

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