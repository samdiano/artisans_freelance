@extends('user')

@section('css')

    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@stop
@section('content')

    @include('partials.breadcrumb')

    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        @include('partials.profile')

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">

                    <div class="login-admin login-admin">

                        {!! Form::open(['method'=>'PUT','route'=>['update.job'], 'role'=>'form','class'=>'form-horizontal','name' =>'editForm', 'files'=>true]) !!}

                        <div class="row">

                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Project Title :</strong></label>
                                    <div class="col-md-12">
                                        <input type="hidden" name="id" value="{{$project->id}}">
                                        <input type="text" name="title"
                                               placeholder="Project Title ..." value="{{$project->title}}"
                                               class="{{ $errors->has('title') ? ' is-invalid' : '' }}">
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback error-color red">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Project Keywords :</strong></label>
                                    <div class="col-md-12">
                                        <input type="text" name="keywords" value="{{$project->keywords}}"
                                               placeholder="Project Keywords ..."
                                               class="{{ $errors->has('keywords') ? ' is-invalid' : '' }}">
                                        @if ($errors->has('keywords'))
                                            <span class="invalid-feedback error-color red">
                                                    <strong>{{ $errors->first('keywords') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <label class="col-md-12"><strong>Project Description :</strong>
                            </label>
                            <div class="col-md-12 ">
                                <div class="textColor white-bg">
                                        <textarea name="description" rows="15" id="area1"
                                                  class="{{ $errors->has('description') ? ' is-invalid' : '' }} form-control"> {{$project->description}}</textarea>
                                </div>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback error-color red">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 "><strong>Experience :</strong></label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{$project->experience}}"
                                               class="{{ $errors->has('experience') ? ' is-invalid' : '' }}"
                                               name="experience">
                                        @if ($errors->has('experience'))
                                            <span class="invalid-feedback error-color red">
                                                    <strong>{{ $errors->first('experience') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Job Category :</strong></label>
                                    <div class="col-md-12">
                                        <select name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($category as $item)
                                                <option value="{{$item->id}}">{{ $item->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span class="invalid-feedback error-color red">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 "><strong>Job Salary
                                            :</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group input-group-md">
                                            <input type="text" value="{{$project->salary}}"
                                                   class="{{ $errors->has('salary') ? ' is-invalid' : '' }}"
                                                   name="salary">
                                            <span class="input-group-addon">
                                              {{$basic->currency}}
                                            </span>
                                        </div>

                                        @if ($errors->has('salary'))
                                            <span class="invalid-feedback error-color red">
                                                    <strong>{{ $errors->first('salary') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 "><strong>Job Time
                                            :</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group input-group-md date" id="date"
                                             data-provide="datepicker">
                                            <input type="text" name="deadline" class=" form-control"
                                                   value="{{date('m/d/Y', strtotime($project->deadline))}}" required>
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail"
                                         style="width: 200px; height: 150px;"
                                         data-trigger="fileinput">

                                        @if($project->image == null)
                                            <img style="width: 200px"
                                                 src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Project Thumbnail"
                                                 alt="...">
                                        @else

                                            <img style="width: 200px"
                                                 src="{{asset('assets/images/project/'.$project->image)}}"
                                                 alt="...">
                                        @endif

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px"></div>

                                    <div class="img-input-div">
                                                <span class="btn btn-primary btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                                class="fa fa-file-image-o"></i> Select Thumbnail </span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                                class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image"
                                                           class="{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                                           accept="image/*">
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase"
                                           data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback error-color red">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-md-12">
                                <br>
                                <input type="submit" class="btn-block  btn btn-primary" value="SUBMIT JOB">
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>

                </div>
                <!--end left column-->

            </div>
        </div>
    </div>

    <!-- Blog Single Section End -->

    <div class="clearfix"></div>

    <script>
        document.forms['editForm'].elements['category_id'].value = {{$project->category_id}}
    </script>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        // $('.datepicker').datepicker();
        var date = new Date();
        date.setDate(date.getDate());

        $('#date').datepicker({
            startDate: date
        });

    </script>

    <script type="text/javascript" src="{{asset('assets/admin/js/nicEdit-latest.js')}}"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function () {
            new nicEditor({fullPanel: true}).panelInstance('area1');
        });
    </script>

@endsection
