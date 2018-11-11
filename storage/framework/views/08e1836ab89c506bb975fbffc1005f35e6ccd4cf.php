<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/front/css/biography.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="section-bottom-80 section-background" id="min-height-activity">
        <div class="parallax section parallax-off"
             style="
             <?php if($user->cover != null): ?>
                     background-image:url(<?php echo e(asset('assets/images/user/'.$user->cover)); ?>);
             <?php else: ?>
                     background-image:url(<?php echo e(asset('assets/images/logo/breadcrumb.jpg')); ?>);
             <?php endif; ?>
                     ">
            <div class="container">
                <div class="page-title text-center">
                    <?php if($user->image != null): ?>
                        <img src="<?php echo e(asset('assets/images/user/'.$user->image)); ?>" alt="<?php echo e($user->image); ?>"
                             class="profile-image img-circle img-responsive">
                    <?php endif; ?>
                    <div class="heading-holder">
                        <h1><?php echo e($user->name); ?></h1>
                    </div>
                    <p class="lead"><?php echo $user->company_tagline; ?></p>
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

        <div class="section lb">
            <div class="container">
                <div class="row">
                    <div class="content col-md-7">
                        <div class="panel panel-primary">
                            <div class="panel-heading panel-bio ">
                                <h6>About <?php echo e($user->name); ?></h6>
                            </div>
                            <div class="panel-body">

                                <div class="link-widget">
                                    <ul class="check ">
                                        <p><?php echo $user->company_description; ?></p>
                                    </ul><!-- end check -->
                                </div><!-- end link-widget -->
                            </div>
                        </div>

                    </div><!-- end col -->

                    <div class="sidebar col-md-5">
                        

                        <div class="panel panel-primary">
                            <div class="panel-heading panel-bio ">
                                <h6> <?php echo e($user->name); ?> Info</h6>
                            </div>
                            <div class="panel-body">


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Email</h4>
                                            <small><?php echo e($user->email); ?></small>
                                        </div><!-- end small -->
                                    </div><!-- end col -->
                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Phone</h4>
                                            <small><?php echo e($user->phone); ?></small>
                                        </div><!-- end small -->
                                    </div><!-- end col -->
                                </div>

                                <hr class="invis">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Company Type</h4>
                                            <small><?php echo e(isset($user->category->name) ? $user->category->name : ''); ?></small>
                                        </div><!-- end small -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Member Since</h4>
                                            <small><?php echo e(date('F, Y', strtotime($user->created_at))); ?></small>
                                        </div><!-- end small -->
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div>
                        </div>

                        

                        <?php
                            $projects = \App\Project::where('user_id', $user->id)->where('approve',1)->latest()->take(3)->get();
                        ?>

                        <?php if(count($projects)>0): ?>
                            <div class="widget clearfix">
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-bio ">
                                        <h6>About Jobs From <?php echo e($user->name); ?></h6>
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="table-responsive job-table">
                                                    <table id="mytable"
                                                           class="table table-striped table-bordered table-hover">

                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Job Title</th>
                                                            <th scope="col">Type</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $slug = str_slug($data->title);
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <h4>
                                                                        <a href="<?php echo e(route('details.job',[$data->id,$slug])); ?>"
                                                                           class="black"><?php echo e($data->title); ?></a><br>
                                                                        <small>Deadline
                                                                            : <?php echo e(date('d.m.Y', strtotime($data->deadline))); ?></small>
                                                                    </h4>
                                                                </td>
                                                                <td data-label="Type">
                                                                    <a class="default-cursor black"><?php echo e($data->category->name); ?></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </tbody>
                                                    </table>
                                                </div><!-- end table -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- end post-padding -->
                        <?php endif; ?>

                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end section -->

    </div>
    <!-- Blog Single Section End -->

    <div class="clearfix"></div>



    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 750);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 750);
            console.log(bodyHeight)
        }(jQuery))
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>