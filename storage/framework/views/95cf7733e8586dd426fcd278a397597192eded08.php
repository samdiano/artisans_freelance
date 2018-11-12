<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/front/css/homepage.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/highlaw.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/mirex.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/magnific-popup.css')); ?>" rel="stylesheet">
    <style>

        <?php $i=0?>
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        .header-area .carousel-thumb<?php echo e(++$i); ?>  {
            background: url(<?php echo e(asset('assets/images/slider/'.$data->image)); ?>);
            background-attachment: fixed;
            background-size: cover;
            background-position: center center;
            padding: 160px 0;
        }
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <!--Header section start-->
    <section id="particles-js" class="header-area">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->

            <div class="carousel-inner" role="listbox">
                <?php $i=0?>
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item <?php if($i ==0): ?> active <?php endif; ?> carousel-thumb<?php echo e(++$i); ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 text-center">
                                    <div class="header-section-wrapper">
                                        <div class="header-section-top-part">
                                            <h5><?php echo e($data->title); ?></h5>
                                            <h1><?php echo e($data->sub_title); ?></h1>
                                            <p><?php echo $data->description; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!-- Controls -->
            <a class="left carousel-control1" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control1" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!--Header section end-->
    <div class="clearfix"></div>

    <!-- Admin section start -->
    <div class="admin-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- admin content start -->
                    <div class="admin-content">
                        <!-- admin text start -->
                        <div class="admin-text">
                            <h2>Get access to Your account</h2>
                        </div>
                        <!-- admin text end -->
                        <!-- admin user start -->
                        <div class="admin-user">
                            <a href="<?php echo e(route('login')); ?>">
                                <button class="button-hover" type="submit" name="login">sign in</button>
                            </a>
                            <a href="<?php echo e(route('register')); ?>">
                                <button type="submit" name="register">register now</button>
                            </a>
                        </div>
                        <!-- admin user end -->
                    </div>
                    <!-- admin-content end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Admin section end -->
    <div class="clearfix"></div>



    <!-- about area start -->
    <section class="about-us-aera">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-offset-2 col-md-8 col-md-offset-2">
                    <div class="section-title text-center">
                        <h2 class="title text-uppercase"> <strong><?php echo e($basic->about_heading); ?></strong></h2>
                        <p class="description"><?php echo e($basic->about_sub_title); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="left-content-area"><!-- let content area -->
                        <div class="thumb">
                            <img src="<?php echo e(asset('assets/images/logo/'.$basic->about_image)); ?>" alt="about left image">
                            <div class="hover">
                                <a href="<?php echo e($basic->video_link); ?>" class="mfp-iframe video-play-btn"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div><!-- //. left content area -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="right-content-area"><!-- right content area -->
                        <?php echo $basic->short_about_text; ?>


                    </div><!-- //.right content area -->
                </div>
            </div>
        </div>
    </section>
    <!-- about area end -->


    <!-- our practise area start -->
    <section class="practise-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                    <div class="section-title text-center white">
                        <h2 class="title">
                            <strong><?php echo e($basic->featured_title); ?></strong>
                        </h2>
                        <p class="description white"><?php echo e($basic->featured_detail); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                    <div class="single-practise-box margin-bottom-40"><!-- single practise box -->
                        <div class="icon">
                            <?php echo $data->icon; ?>

                        </div>
                        <div class="content">
                            <a ><h4 class="title"><?php echo e($data->title); ?></h4></a>
                            <p><?php echo e($data->details); ?></p>
                        </div>
                    </div><!-- //. single practise box -->
                </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <!-- our practise area end -->



    <!-- how it work area start -->
    <section class="how-it-work how-it-work-bg ">

        <div class="container">
            <div class="how-it-work-progress ">
                <img src="<?php echo e(asset('assets/images/how-it-work-vector.png')); ?>" class="cloud5" alt="how it work progress">
            </div>
            <div class="row text-center">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="section-title text-center">
                        <span class="subtitle"><?php echo e($basic->service_sub_title); ?></span>
                        <h2 class="title"><?php echo e($basic->service_title); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $color = array('','two','three');
                ?>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single-how-it-work <?php echo e($color[$k]); ?> wow fadeInUp"><!-- single how it work -->
                        <div class="icon">
                            <?php echo $data->icon; ?>

                        </div>
                        <div class="content">
                            <h4 class="title"><?php echo e($data->title); ?></h4>
                            <p><?php echo $data->details; ?></p>
                        </div>
                    </div><!-- //.single how it work -->
                </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <!-- how it work area end -->


    <section class="our-attorney-area"></section>


    <!-- counter and subscribe area start -->
    <section class="counter-and-subscribe-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                    <div class="single-counter-box"><!-- single counter box -->
                        <div class="bg-icon"><i class="pe-7s-users"></i></div>
                        <div class="counter-number">
                            <span class="count-numb"><?php echo e($freelancer); ?></span>
                        </div>
                        <h4 class="name">Freelancer</h4>
                    </div><!-- //. single counter box -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                    <div class="single-counter-box rrmt-30">
                        <!-- single counter box -->
                        <div class="bg-icon two"><i class="pe-7s-users"></i></div>
                        <div class="counter-number">
                            <span class="count-numb"><?php echo e($employer); ?></span>
                        </div>
                        <h4 class="name">Employer</h4>
                    </div>
                    <!-- //. single counter box -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                    <div class="single-counter-box rmt-30">
                        <!-- single counter box -->
                        <div class="bg-icon three"><i class="pe-7s-news-paper"></i></div>
                        <div class="counter-number">
                            <span class="count-numb"><?php echo e($jobs); ?></span>
                        </div>
                        <h4 class="name">Jobs</h4>
                    </div>
                    <!-- //. single counter box -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="subscribe-outer-wrapper"><!-- subscribe form wrapper -->
                        <h2 class="title">Subscribe for more updates</h2>
                        <div class="subscribe-form-wrapper">
                            <form action="<?php echo e(route('subscribe')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-element">
                                    <input type="email" name="email" placeholder="Enter your email address" class="input-field">
                                </div>
                                <input type="submit" value="subscribe" class="submit-btn">
                            </form>
                        </div>
                    </div><!-- subscribe form wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- counter and subscribe area end -->




    <div class="clearfix"></div>


    <style>
        .owl-carousel .owl-item img {
            width: auto;
        }
        .single-testimonial-item {
            margin-bottom: 50px;
        }
    </style>

    <div class="parallax section overlay" data-stellar-background-ratio="0.5"
         style="background-image:url('assets/images/logo/testimonial.jpg'); background-position: 0px 66.4844px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme testimonials" id="testimonial-carousel">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-testimonial-item">
                                    <blockquote>
                                        <p class="clients-words"><?php echo $testimonial->details; ?></p>
                                        <span class="clients-name text-primary">— <?php echo e($testimonial->name); ?></span>
                                        <img class="img-circle img-thumbnail"
                                             src="<?php echo e(asset('assets/images/testimonial/'.$testimonial->image)); ?>"
                                             alt="<?php echo e($testimonial->name); ?>">
                                    </blockquote>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div><!--/.col-->
            </div><!--/.row-->
        </div><!-- end container -->
    </div><!-- end section -->




    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-home').css('min-height', parseInt(bodyHeight) - 550);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-home').css('min-height', parseInt(bodyHeight) - 550);
            console.log(bodyHeight)


        }(jQuery))
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/front/js/particles.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/custom-particles.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/TweenMax.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/mousemoveparallax.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


    <script>
        $(document).ready(function() {
            $('.video-play-btn,.video-popup,.small-vide-play-btn').magnificPopup({
                type: 'video'
            });

            var owlTestimonial = $('#testimonial-carousel');
            owlTestimonial.owlCarousel({
                margin:30,
                loop:true,
                autoplay:true,
                autoplayTimeout:5000,
                autoplayHoverPause:true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    960: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    },
                    1920: {
                        items: 4
                    }
                }
            })
        })
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>