<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/front/css/biography.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/biography-user.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="section-background section-bottom-80" id="min-height-activity">
        <div class="parallax section parallax-off"
             style="<?php if($user->cover != null): ?>
                     background-image:url(<?php echo e(asset('assets/images/user/'.$user->cover)); ?>);
             <?php else: ?>
                     background-image:url(<?php echo e(asset('assets/images/logo/breadcrumb.jpg')); ?>);
             <?php endif; ?>">
            <div class="container">
                <div class="page-title text-center">

                    <?php if(file_exists( 'assets/images/user/'.$user->image) && ($user->image != null)): ?>
                        <img src="<?php echo e(asset('assets/images/user').'/'.$user->image); ?>" alt="Image"
                             class="profile-image img-circle img-responsive">
                    <?php endif; ?>

                    <div class="heading-holder">
                        <h1><?php echo e($user->name); ?></h1>
                    </div>
                    <p class="lead"><?php echo e($user->title); ?></p>
                    <ul class="list-inline social-small">
                        <?php if($user->web != null): ?>
                            <li><a href="<?php echo e($user->web); ?>"><i class="fa fa-link"></i></a></li>
                        <?php endif; ?>

                        <?php if($user->fb != null): ?>
                            <li><a href="<?php echo e($user->fb); ?>"><i class="fa fa-facebook"></i></a></li>
                        <?php endif; ?>
                        <?php if($user->twitter != null): ?>
                            <li><a href="<?php echo e($user->twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                        <?php endif; ?>
                        <?php if($user->google_plus != null): ?>
                            <li><a href="<?php echo e($user->google_plus); ?>"><i class="fa fa-google-plus"></i></a></li>
                        <?php endif; ?>
                        <?php if($user->linkedin != null): ?>
                            <li><a href="<?php echo e($user->linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div><!-- end container -->
        </div><!-- end section -->

        <?php if($user->resume): ?>
            <div class="section lb">
                <div class="container">
                    <div class="row">
                        <div class="content col-md-8 black">
                            <div class="panel panel-primary">
                                <div class="panel-heading panel-bio ">
                                    <h6>About <?php echo e($user->name); ?></h6>
                                </div>
                                <div class="panel-body">

                                    <p class="lead"><?php if($user->resume->skills != null): ?>
                                            Skills: <?php echo e(isset($user->resume->skills) ? $user->resume->skills : ''); ?> <?php endif; ?></p>
                                    <br>
                                    <div class="link-widget">
                                        <ul class="check ">
                                            <p><?php echo isset($user->resume->resume_description) ? $user->resume->resume_description : ' '; ?></p>
                                        </ul><!-- end check -->
                                    </div><!-- end link-widget -->
                                </div>
                            </div>

                        </div><!-- end col -->

                        <div class="sidebar col-md-4">


                            <div class="panel panel-primary">
                                <div class="panel-heading panel-bio ">
                                    <h6>Expected Charge Per Hour</h6>
                                </div>
                                <div class="panel-body">

                                    <div class="link-widget">
                                        <ul class="check ">
                                            <p>
                                                <?php if(($user->resume->minimum_salary != null) or  ($user->resume->maximum_salary != null)): ?>
                                                    <span class="text-center black"><?php echo e(isset($user->resume->minimum_salary) ? $user->resume->minimum_salary : ''); ?>

                                                        <?php if($user->resume->maximum_salary): ?>
                                                            - <?php echo e(isset($user->resume->maximum_salary) ? $user->resume->maximum_salary : ''); ?> <?php endif; ?> <?php echo e($basic->currency_sym); ?> </span>
                                                <?php endif; ?>

                                            </p>
                                        </ul>
                                    </div><!-- end link-widget -->


                                </div>
                            </div>


                            <?php if($user->resume->institute != null): ?>
                                <br><br>
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-bio ">
                                        <h6>Education</h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="link-widget">
                                            <ul class="check ">
                                                <p><?php echo e($user->resume->institute); ?>

                                                    , <?php echo e($user->resume->institute_duration); ?></p>
                                                <p><?php echo e($user->resume->institute_qualification); ?> </p>
                                                <p><?php echo e($user->resume->institute_notes); ?> </p>
                                            </ul><!-- end check -->
                                        </div><!-- end link-widget -->
                                    </div>
                                </div>

                            <?php endif; ?>

                            <?php if($user->resume->institute != null): ?>
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-bio ">
                                        <h6>Experience</h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="link-widget">
                                            <ul class="check ">
                                                <p><?php echo e($user->resume->company_name); ?></p>
                                                <p><?php echo e($user->resume->position); ?>

                                                    , <?php echo e($user->resume->experience_duration); ?></p>
                                                <p><?php echo e($user->resume->experience_notes); ?></p>
                                            </ul><!-- end check -->
                                        </div><!-- end link-widget -->
                                    </div>
                                </div>

                            <?php endif; ?>

                            <div class="widget post-padding clearfix">


                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end container -->
                </div><!-- end section -->
            </div>
    <?php endif; ?>
    <!-- Blog Single Section End -->

    </div>

    <div class="clearfix"></div>


    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 800);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 800);
            console.log(bodyHeight)
        }(jQuery))
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>