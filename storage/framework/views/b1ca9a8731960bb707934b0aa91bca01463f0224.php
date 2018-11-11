

<?php $__env->startSection('css'); ?>
    <style>
        table tr td {
            padding: 15px 10px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <aside>
                        <?php echo $__env->make('partials.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <?php echo e($page_title); ?>

                            </div>
                        </div>

                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                <tr>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Employer</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($projects) > 0): ?>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="tr textColor">
                                            <td data-label="Job Title">
                                                <?php
                                                    $slug =  str_slug($data->project->title);
                                                $newMilstone =  $data->mileStones->where('is_read',0)->count();
                                                ?>
                                                <a href="<?php echo e(route('details.job',[$data->project->id, $slug])); ?>">
                                                    <h6><?php echo e($data->project->title); ?> </h6>

                                                   <?php if($newMilstone> 0): ?> <span class="badge badge-info padding-tb-10"><?php echo e($newMilstone); ?> new milestone</span><?php endif; ?>
                                                </a>
                                                <br>
                                                <small class="textColor">Deadline : <?php echo e(date('m.d.Y',strtotime($data->deadline))); ?>

                                                </small>
                                            </td>
                                            <td data-label="Freelancer">
                                                <a href="<?php echo e(route('biography',[$data->author->id, $data->author->name])); ?>" class="textColor">
                                                    <?php echo e($data->author->name); ?>

                                                </a>
                                            </td>
                                            <td data-label="Action">
                                                <?php if($data->status == 0): ?>
                                                    <a href="<?php echo e(route('projectMileStoneList',[$data->id,$slug])); ?>" class=" btn btn-info btn-sm"
                                                            title="Milestone List">
                                                        <i class="fas fa-hand-holding-usd"></i>
                                                    </a>

                                                    <button data-toggle="modal" data-target="#small" value="3"
                                                            data-id="<?php echo e($data->id); ?>"
                                                            class="delete_button btn btn-danger btn-sm"
                                                            title="Remove">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">You have no awarded Job List !!</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                            <?php echo $projects->links(); ?>

                        </div>
                    </div>

                </div>
                <!--end left column-->

            </div>
        </div>
    </div>
    <!-- Blog Single Section End -->
    <div class="clearfix"></div>



    <!-- Modal -->
    <div class="modal fade" role="dialog" id="small">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title"><i class="fa fa-trash"></i> Remove !</h6>
                </div>
                <div class="modal-body">
                    <p>Are you sure to remove job from this user ?</p>
                </div>
                <div class="modal-footer">
                    <form action="<?php echo e(route('cancelClientJob')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" id="confirm_id">
                        <button type="submit" id="confirm_accept" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete_button', function () {
                var id = $(this).data('id');
                $('#confirm_id').val(id);
            });
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>