@extends('user')
@section('content')

    @include('partials.breadcrumb')


    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-changpass">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        @include('partials.profile')

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                        <div class="login-admin login-admin1">
                                <div class="login-form remove-margin-bottom">
                                    <!-- BEGIN SAMPLE FORM PORTLET-->
                                    <form action="" method="post" role="form">
                                        {!! csrf_field() !!}
                                        <input name="current_password"
                                               class="{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                                               placeholder="Current Password" type="password">
                                        @if ($errors->has('current_password'))
                                            <span class="invalid-feedback error-color red">
                                <strong>{{ $errors->first('current_password') }}</strong>
                            </span>
                                        @endif
                                        <div class="margin-bottom-26"></div>
                                        <input name="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               placeholder="New Password" type="password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback error-color red">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                        @endif
                                        <div class="margin-bottom-26"></div>
                                        <input name="password_confirmation" placeholder="Confirm Password " type="password">
                                        <div class="margin-bottom-26"></div>

                                        <input type="submit" value="Change Password">
                                    </form>
                                </div>
                            </div><!---ROW-->

                </div>
                <!--end left column-->

            </div>
        </div>
    </div>


    <script>
        (function($){
            $(window).on('resize',function(){
                var bodyHeight = $(window).height();
                $('#min-height-changpass').css('min-height',parseInt(bodyHeight) - 650);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-changpass').css('min-height',parseInt(bodyHeight) - 650);
            console.log(bodyHeight)


        }(jQuery))
    </script>
@endsection

@section('script')
    @if (session('message'))

        <script type="text/javascript">

            $(document).ready(function () {

                swal("Success!", "{{ session('message') }}", "success");

            });

        </script>

    @endif



    @if (session('alert'))

        <script type="text/javascript">

            $(document).ready(function () {

                swal("Sorry!", "{{ session('alert') }}", "error");

            });

        </script>

    @endif
@endsection
