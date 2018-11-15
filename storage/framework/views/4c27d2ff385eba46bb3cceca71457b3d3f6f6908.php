<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/front/css/job-list.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <section class="about-section section-padding-2 section-bg-clr1" id="min-height-joblist">
        <div class="container">
            <div class="all-jobs job-listing clearfix">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="postlist-tab">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="post-meta">
                                    <?php
                                        $img = 'assets/images/user/'.$data->image;
                                        $slug = str_slug($data->name);

                                        $biography = str_slug($data->name)
                                    ?>
                                    <a href="<?php echo e(route('biography',[$data->id, $biography])); ?>">
                                        <?php if($data->image != null): ?>
                                            <img src="<?php echo e(asset('assets/images/user/'.$data->image)); ?>" alt="image"
                                                 class="img-responsive img-thumbnail">
                                        <?php else: ?>
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text= Profile"
                                                 alt="image" class="img-responsive img-thumbnail">
                                        <?php endif; ?>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="label  badge-highlight"><?php echo e(isset($data->category->name) ? $data->category->name : ' '); ?></div>
                                <h3><a href="<?php echo e(route('biography',[$data->id, $biography])); ?>"><?php echo isset($data->name) ? $data->name : '-'; ?></a>
                                </h3>
                                <small>
                                    <?php if($data->resume): ?>
                                        <span class="span-color">Skills : <?php echo isset($data->resume->skills) ? $data->resume->skills : ''; ?></span>
                                    <?php endif; ?>
                                </small>
                            </div><!-- end col -->

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="job-meta">
                                    <div class="margin-bottom-50"></div>
                                    <small>
                                        <span class="span-color"> Last Login : <?php if($data->userLogin['created_at'] != ''): ?> <?php echo e(Carbon\Carbon::parse($data->userLogin['created_at'])->diffForHumans()); ?> <?php else: ?> Never <?php endif; ?></span>
                                    </small>
                                </div><!-- end meta -->
                            </div><!-- end col -->

                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="job-meta text-center">
                                    <?php if($data->resume): ?>
                                        <h4 class="salary"> <?php echo e($basic->currency_sym); ?> <?php echo e(isset($data->resume->minimum_salary) ? $data->resume->minimum_salary : ''); ?> <?php if($data->resume->maximum_salary != null ): ?>
                                                - <?php echo e(isset($data->resume->maximum_salary) ? $data->resume->maximum_salary : ''); ?> <?php endif; ?></h4>
                                    <?php endif; ?>

                                    <a href="<?php echo e(route('biography',[$data->id, $biography])); ?>"
                                       class="btn btn-primary btn-sm btn-block">View Profile</a>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end job-tab -->




                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div><!-- end alljobs -->

            <div class="loadmore_button text-center clearfix">
                <a href="#" class="btn btn-primary" id="loadMore">See More Freelancer</a>
            </div><!-- end loadmore -->
        </div><!-- end container -->
    </section>
    <!-- About Hostonion End -->

    <div class="clearfix"></div>


    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-joblist').css('min-height', parseInt(bodyHeight) - 550);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-joblist').css('min-height', parseInt(bodyHeight) - 550);
            console.log(bodyHeight)

            /* ==============================================
                LOAD MORE
           =============================================== */

            $(function () {
                $(".postlist-tab").slice(0, 6).show();
                $("#loadMore").on('click', function (e) {
                    e.preventDefault();
                    $(".postlist-tab:hidden").slice(0, 4).slideDown();
                    if ($(".postlist-tab:hidden").length == 0) {
                        $("#load").fadeOut('slow');
                    }
                });
            });


        }(jQuery))
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>