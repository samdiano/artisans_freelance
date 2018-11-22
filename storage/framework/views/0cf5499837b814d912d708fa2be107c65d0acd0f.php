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
                        <span class="caption-subject bold uppercase"> User List</span>
                    </div>
                    <div class="tools"></div>
                    <div class="actions">
                        <form method="POST" class="form-inline" action="<?php echo e(route('search.users')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <input type="text" name="search" class="form-control" placeholder="Search">
                            <button class="btn btn-outline btn-circle btn-sm green" type="submit"><i
                                        class="fa fa-search"></i></button>

                        </form>
                    </div>
                </div>

                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td data-label="Name"><?php echo e($user->name); ?></td>
                                <td data-label="Email"><?php echo e($user->email); ?></td>
                                <td data-label="Username"><?php echo e($user->username); ?></td>
                                <td data-label="Mobile"><?php echo e(isset($user->phone) ? $user->phone : 'N/A'); ?></td>
                                <td data-label="Balance"><?php echo e($user->balance); ?> <?php echo e($basic->currency); ?></td>
                                <td  data-label="Details">
                                    <a href="<?php echo e(route('user.single', $user->id)); ?>"
                                       class="btn btn-outline btn-circle btn-sm green">
                                        <i class="fa fa-eye"></i> View </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>