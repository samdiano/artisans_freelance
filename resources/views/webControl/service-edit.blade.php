@extends('admin.layout.master')
@section('css')

@stop
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
                        <span class="caption-subject bold uppercase">
                            <i class="fa fa-edit"></i> Edit {{$service->title}}
                        </span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" action="{{ route('service-update',$service->id) }}" method="post" role="form" enctype="multipart/form-data">

                        {!! csrf_field() !!}
                        <div class="form-body">
                            <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
                                <label class="col-md-12"><strong style="text-transform: uppercase;">Font-awesome Icon</strong></label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                    <input class="form-control input-lg" value="{{ $service->icon }}" name="icon" type="text" >
                                        <div class="input-group-addon"><span class="input-group-text">
                                            {!!  $service->icon !!}
                                            </span>
                                        </div>

                                    </div>
                                    @if ($errors->has('icon'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('icon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label class="col-md-12"><strong style="text-transform: uppercase;">Title</strong></label>
                                <div class="col-md-12">
                                    <input class="form-control input-lg" value="{{ $service->title }}" name="title" placeholder="" type="text" >
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label class="col-md-12"><strong style="text-transform: uppercase;">Details</strong></label>
                                <div class="col-md-12">
                                    <textarea name="details" class="form-control input-lg" rows="5">{{ $service->details }}</textarea>
                                    @if ($errors->has('details'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('details') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn blue btn-block btn-lg"><i class="fa fa-send"></i> UPDATE </button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>



@stop

@section('script')

@stop