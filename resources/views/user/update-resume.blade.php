@extends('user')
@section('css')
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

                        <form method="post" action="" class="form-horizontal">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12 "><strong>Resume Skills :</strong></label>
                                        <div class="col-md-12">
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                            <input type="text" name="skills" value="{{$user->skills}}"
                                                   placeholder="Your Skills">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong>Minimum Salary :</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="minimum_salary"
                                                       value="{{$user->minimum_salary}}" placeholder="Amount">
                                                <span class="input-group-addon">{{$basic->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong>Maximum Salary :</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="maximum_salary"
                                                       value="{{$user->maximum_salary }}" placeholder="Amount">
                                                <span class="input-group-addon">{{$basic->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <label><strong>Education :</strong></label>
                                            <input type="text" name="institute" value="{{$user->institute }}"
                                                   placeholder="Institute name">
                                        </div>

                                        <div class="panel-body">
                                            <input type="text" name="institute_duration"
                                                   value="{{$user->institute_duration }}"
                                                   placeholder="Start / End Date">
                                        </div>
                                        <div class="panel-body">
                                            <input type="text" name="institute_qualification"
                                                   value="{{$user->institute_qualification}}"
                                                   placeholder="Qualifications">
                                        </div>
                                        <div class="panel-body">
                                            <input type="text" name="institute_notes"
                                                   value="{{$user->institute_notes}}" placeholder="Extra Notes..">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <label><strong>Experience :</strong></label>
                                            <input type="text" name="company_name" value="{{$user->company_name }}"
                                                   placeholder="Company Name">
                                        </div>

                                        <div class="panel-body">
                                            <input type="text" name="position" value="{{ $user->position}}"
                                                   placeholder="Position">
                                        </div>
                                        <div class="panel-body">
                                            <input type="text" name="experience_duration"
                                                   value="{{$user->experience_duration }}"
                                                   placeholder="Start / End Date">
                                        </div>
                                        <div class="panel-body">
                                            <input type="text" name="experience_notes"
                                                   value="{{$user->experience_notes}}" placeholder="Extra Notes..">
                                        </div>
                                    </div>
                                </div>



                                <label class="col-md-12"><strong>About You :</strong></label>
                                <div class="col-md-12 ">
                                        <div class="textColor white-bg">
                                            <textarea name="resume_description" id="area1"
                                                      placeholder="Say Something About You" rows="15" class="form-control">{!! $user->resume_description !!}</textarea>
                                        </div>
                                </div>

                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong>Languages :</strong></label>
                                        <div class="col-md-12">
                                            <input type="text" name="language" value="{{$user->language}}"
                                                   placeholder="Language">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <input type="submit" class="btn-block  btn btn-primary" value="UPDATE Resume">
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
                <!--end left column-->

            </div>
        </div>
    </div>

    <!-- Blog Single Section End -->

    <div class="clearfix"></div>

@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/js/nicEdit-latest.js')}}"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function () {
            new nicEditor({fullPanel: true}).panelInstance('area1');
        });
    </script>

@endsection

