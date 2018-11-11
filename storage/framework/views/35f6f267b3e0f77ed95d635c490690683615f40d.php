
<?php $__env->startSection('import-css'); ?>
    <link href="<?php echo e(asset('assets/admin/css/bootstrap-fileinput.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> <?php echo e($page_title); ?>


            </h3>
            <hr>


            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-photo"></i> <strong><?php echo e($page_title); ?></strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">

                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Change
                                            Breadcrumb</strong></label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new bold"> Change Breadcrumb </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="breadcrumb"> </span>
                                                <a href="javascript:;"
                                                   class="input-group-addon btn red fileinput-exists"
                                                   data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <code>Breadcrumb Mimes Type:jpg</code>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption uppercase bold"><i class="fa fa-photo"></i> Current Image
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <img class="img-responsive"
                                             src="<?php echo e(asset('assets/images/logo/breadcrumb.jpg')); ?>" alt="breadcrumb">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Change
                                            Testimonial Background</strong></label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new bold"> Change Background </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="testimonial"> </span>
                                                <a href="javascript:;"
                                                   class="input-group-addon btn red fileinput-exists"
                                                   data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <code>Testimonial Image Mimes Type:jpg</code>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption uppercase bold"><i class="fa fa-photo"></i> Current Background Image
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <img class="img-responsive"
                                             src="<?php echo e(asset('assets/images/logo/testimonial.jpg')); ?>" alt="image" style="height: 400px">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary bold btn-block"><i class="fa fa-send"></i>
                                    UPDATE
                                </button>
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