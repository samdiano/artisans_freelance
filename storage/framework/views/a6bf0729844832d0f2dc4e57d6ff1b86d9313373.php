
<?php $__env->startSection('import-css'); ?>
    <link href="<?php echo e(asset('assets/admin/css/jquery.fileupload.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
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
                    <form role="form" method="POST" action="<?php echo e(route('manage-logo')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-primary minh-185">
                                    <div class="panel-heading">Present Logo</div>
                                    <div class="panel-body">
                                        <img src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" class="img-responsive"
                                             width="" height="120px">
                                    </div>
                                </div>
                                <div class="form-group<?php echo e($errors->has('logo') ? ' has-error' : ''); ?>">
                                            <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                            <span> Upload New Logo </span>
                                            <input type="file" name="logo" class="form-control input-lg"> </span>
                                    <?php if($errors->has('logo')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('logo')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-primary minh-185">
                                    <div class="panel-heading">Present Icon</div>
                                    <div class="panel-body">
                                        <img src="<?php echo e(asset('assets/images/logo/favicon.png')); ?>" class="img-responsive"
                                             width="" height="120px">
                                    </div>
                                </div>
                                <div class="form-group<?php echo e($errors->has('favicon') ? ' has-error' : ''); ?>">
                                    <span class="btn green fileinput-button">
                                        <i class="fa fa-plus"></i>
                                        <span> Upload New Icon </span>
                                        <input type="file" name="favicon" class="form-control input-lg" >
                                    </span>
                                    <?php if($errors->has('favicon')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('favicon')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-actions right col-md-12">
                                <button type="submit" class="btn blue btn-lg btn-block">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('import-script'); ?>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-fileinput.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>