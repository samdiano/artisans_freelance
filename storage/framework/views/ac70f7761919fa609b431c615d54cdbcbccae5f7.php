
<?php $__env->startSection('import-css'); ?>
    <link href="<?php echo e(asset('assets/admin/css/bootstrap-fileinput.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> <?php echo e($page_title); ?>


            </h3>
            <hr>

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <strong><i class="fa fa-info-circle"></i> <?php echo e($page_title); ?></strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">


                    <?php echo Form::model($basic,['route'=>['manage-footer-update'],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]); ?>

                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-12">


                                <div class="form-group<?php echo e($errors->has('copyright') ? ' has-error' : ''); ?>">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Copyright Text</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="copyright" id="area1" class="form-control" required><?php echo e($basic->copyright); ?></textarea>
                                        <?php if($errors->has('email')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn blue btn-block btn-lg"><i class="fa fa-send"></i> UPDATE</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('import-script'); ?>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-fileinput.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>