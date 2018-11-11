<?php $__env->startSection('body'); ?>
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> <?php echo e($page_title); ?>


            </h3>
            <hr>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"><?php echo e($page_title); ?></span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column">
                        <thead>
                        <tr>
                            <th>Username </th>
                            <th>
                                Details
                            </th><th>
                                Details
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $dis_id = [];
                        ?>
                        <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!in_array($dep->milestone_id, $dis_id)): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(route('user.single', $dep->user->id)); ?>">
                                    <?php echo e($dep->user->username); ?>

                                    </a>
                                </td>
                                <td>
                                    <?php if($dep->is_read == 0): ?>
                                        <b><?php echo $dep->report; ?></b>
                                    <?php else: ?>
                                    <?php echo $dep->report; ?>

                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a href="<?php echo e(route('reports.view',$dep->milestone_id)); ?>" class="btn btn-outline btn-circle btn-sm green" >
                                        <i class="fa fa-eye"></i> view </a>
                                </td>
                            </tr>
                        <?php
                            $dis_id[] = $dep->milestone_id;
                        ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>