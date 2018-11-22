<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/front/css/job-list.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <section class="about-section section-bg-clr1" id="min-height-joblist">
        <div class="container">
            <div class="all-jobs job-listing clearfix">
                <?php echo $__env->make('errors.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="postlist-tab">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                             p   <div class="post-meta">
                                    <?php
                                        $img = 'assets/images/project/'.$data->image;
                                        $slug = str_slug($data->title);
                                    ?>
                                    <a href="<?php echo e(route('details.job',[$data->id,$slug])); ?>">
                                        <?php if(file_exists($img)): ?>
                                            <img src="<?php echo e(asset('assets/images/project/'.$data->image)); ?>" alt="image"
                                                 class="img-responsive img-thumbnail">
                                        <?php else: ?>
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Project Thumbnail"
                                                 alt="image" class="img-responsive img-thumbnail">
                                        <?php endif; ?>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="label  badge-highlight"><?php echo e(isset($data->category->name) ? $data->category->name : ' -'); ?></div>
                                <h3><a href="<?php echo e(route('details.job',[$data->id,$slug])); ?>"><?php echo e(isset($data->title) ? $data->title : '-'); ?></a>
                                </h3>

                            </div><!-- end col -->

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="job-meta">
                                    <div class="margin-bottom-26"></div>
                                    <small>
                                        <?php
                                            $biography = str_slug($data->user->name)
                                        ?>
                                        <span class="span-color">Publisher : <a
                                                    href="<?php echo e(route('biography',[$data->user->id, $biography])); ?>"><?php echo e($data->user->name); ?></a></span>
                                        <br>
                                        <span class="span-color">Deadline : <?php echo e(date('d.m.Y', strtotime($data->deadline))); ?> </span>
                                    </small>
                                </div><!-- end meta -->
                            </div><!-- end col -->

                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="job-meta text-center">
                                    <h4 class="salary"> <?php echo e($basic->currency_sym); ?> <?php echo e($data->salary); ?></h4>
                                    <a href="#contactmodal<?php echo e($data->id); ?>" role="button" data-toggle="modal"
                                       class="btn btn-primary btn-sm btn-block">Make Offer</a>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end job-tab -->



                    <div class="modal fade" id="contactmodal<?php echo e($data->id); ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <form action="<?php echo e(route('bit.job.home')); ?>" method="post" name="bitForm"
                                      id="submit" class="submit-form">
                                    <?php echo e(csrf_field()); ?>

                                <div class="modal-body">
                                    <div class="widget clearfix">
                                        <div class="post-padding item-price">
                                            <div class="content-title">
                                                <h4>Apply For : <?php echo e($data->title); ?> </h4>
                                            </div><!-- end widget-title -->

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <input type="hidden" name="project_id" value="<?php echo e($data->id); ?>">
                                                        <input type="hidden" name="author_id" value="<?php echo e($data->user_id); ?>">
                                                        <input type="text" name="offer" class="form-control"
                                                               placeholder="What is your offer  amount ? *">
                                                        <p class="eml"></p>
                                                        <textarea name="message" class="form-control"
                                                                  placeholder="Say Something .. *"></textarea>
                                                        <p class="eml"></p>
                                                    </div>
                                                </div><!-- end row -->

                                        </div><!-- end newsletter -->
                                    </div><!-- end post-padding -->
                                </div>
                                <div class="modal-footer">

                                    <button class="btn btn-primary">APPLY JOB</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div><!-- end alljobs -->

            <div class="loadmore_button text-center clearfix">
                <a href="#" class="btn btn-primary" id="loadMore">Load More Jobs</a>
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