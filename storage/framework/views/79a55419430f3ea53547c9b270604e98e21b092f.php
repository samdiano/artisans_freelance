<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/front/css/bid-joblist.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        <?php echo $__env->make('partials.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <?php if(count($messages) > 0): ?>
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($data->user_id != Auth::user()->id): ?>
                            <div class="all-jobs job-listing freelancer-list nopadlist clearfix">
                                <div class="job-tab">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <?php
                                                $slug = str_slug($data->bitJob->project->title);
                                                $title_id = $data->bitJob->project->id;
                                            ?>

                                            <div class="post-media">
                                                <a href="<?php echo e(route('details.job',[$title_id,$slug])); ?>">
                                                    <?php if(file_exists( 'assets/images/project/'.$data->bitJob->project->image) && ($data->bitJob->project->image != null)): ?>
                                                        <img src="<?php echo e(asset('assets/images/project').'/'.$data->bitJob->project->image); ?>"
                                                             alt="Image" class="img-responsive img-thumbnail">
                                                    <?php else: ?>
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Project Thumnail"
                                                             alt="Image" class="img-responsive img-thumbnail">
                                                    <?php endif; ?>
                                                </a>
                                            </div><!-- end media -->
                                        </div><!-- end col -->

                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <div class="badge part-badge">
                                                <?php if($data->bitJob->user->id == Auth::id()): ?>
                                                    <?php echo e($data->bitJob->author->name); ?>

                                                <?php elseif($data->bitJob->user->id != Auth::id()): ?>
                                                    <?php echo e($data->bitJob->user->name); ?>

                                                <?php endif; ?>
                                            </div>

                                            <div class="padding-top-20">
                                                <h3>
                                                    <?php
                                                        $slug = str_slug($data->bitJob->project->title);
                                                        $title_id = $data->bitJob->project->id;
                                                    ?>
                                                    <a href="<?php echo e(route('details.job',[$title_id,$slug])); ?>">
                                                        <?php echo e($data->bitJob->project->title); ?>

                                                    </a>
                                                </h3>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="job-meta text-center ">
                                                <div class="margin-top-20"></div>
                                                <strong>Last Login : <?php echo e(\Carbon\Carbon::parse($data->bitJob->user->userLogin->created_at)->diffForHumans()); ?></strong>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-2 col-sm-3 col-xs-12">
                                            <?php
                                                $user = Auth::id();
                                                    $chat =  App\Message::where('receiver_id',$user)->where('bit_job_id',$data->bit_job_id)->latest()->first();
                                            ?>
                                            <div class="job-meta text-center ">
                                                <a href="<?php echo e(route('chat.user',$data->bitJob->code)); ?>" class="pull-left messenger">
                                                    <i class="fab fa-facebook-messenger fa-2x"></i>
                                                </a>
                                                <?php
                                                    $chat =  App\Message::where('receiver_id',$user)->where('is_read',0)->where('bit_job_id',$data->bit_job_id)->latest()->get();
                                                ?>

                                                <?php if(count($chat) > 0): ?>
                                                    <h6><?php echo e(count($chat)); ?>  new messages</h6>
                                                <?php endif; ?>
                                            </div>
                                        </div><!-- end col -->

                                    </div><!-- end row -->
                                </div><!-- end job-tab -->
                            </div><!-- end alljobs -->
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php else: ?>
                        <div class="all-jobs job-listing freelancer-list nopadlist clearfix ">
                        <h3 class="text-center padding-tb-20">You have no message yet!! </h3>
                        </div>
                    <?php endif; ?>


                </div>
                <!--end left column-->

            </div>
        </div>
    </div>
    <!-- Blog Single Section End -->
    <div class="clearfix"></div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>