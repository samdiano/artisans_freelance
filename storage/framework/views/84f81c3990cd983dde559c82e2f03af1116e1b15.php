

<?php $__env->startSection('body'); ?>
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> <?php echo e($page_title); ?>


            </h3>
            <hr>
            <div class="portlet light bordered">
                <div class="portlet-title green">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"><?php echo e($page_title); ?></span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <form role="form" method="POST" action="">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Website Title</h4>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" value="<?php echo e($general->sitename); ?>"
                                           name="sitename">
                                    <span class="input-group-addon">
                                        <strong><i class="fa fa-file-text-o"></i></strong>
                                    </span>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <h4>BASE COLOR CODE</h4>
                                <div class="input-group">
                                <input type="color" class="form-control input-lg" value="#<?php echo e($general->bg_color); ?>"
                                       name="bg_color">
                                    <span class="input-group-addon"><i class="fa fa-tint"></i></span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <hr/>
                            <div class="col-md-4">
                                <h4>BASE CURRENCY </h4>
                                <div class="input-group">
                                <input type="text" class="form-control input-lg" value="<?php echo e($general->currency); ?>" name="currency">
                                    <span class="input-group-addon"><strong><i class="fa fa-money"></i></strong></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h4>CURRENCY SYMBOL</h4>
                                <div class="input-group">
                                <input type="text" class="form-control input-lg" value="<?php echo e($general->currency_sym); ?>"
                                       name="currency_sym">
                                    <span class="input-group-addon"><strong><i
                                                    class="fa fa-exclamation-circle"></i></strong></span>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <h4>Decimal After Point</h4>
                                <div class="input-group">
                                <input type="text" class="form-control input-lg" value="<?php echo e($general->decimal); ?>"
                                       name="decimal">
                                    <span class="input-group-addon"><strong>Decimal</strong></span>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <hr/>
                            <div class="col-md-4">
                                <h4>Registration</h4>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="registration" <?php echo e($general->registration == "1" ? 'checked' : ''); ?>>
                            </div>

                            <div class="col-md-4">
                                <h4>EMAIL VERIFICATION</h4>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="email_verification" <?php echo e($general->email_verification == "1" ? 'checked' : ''); ?>>
                            </div>
                            <div class="col-md-4">
                                <h4>SMS VERIFICATION</h4>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="sms_verification" <?php echo e($general->sms_verification == "1" ? 'checked' : ''); ?>>
                            </div>
                        </div>
                        <div class="row">
                            <hr/>
                            <div class="col-md-4">
                                <h4>EMAIL NOTIFICATION</h4>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="email_notification" <?php echo e($general->email_notification == "1" ? 'checked' : ''); ?>>
                            </div>
                            <div class="col-md-4">
                                <h4>SMS NOTIFICATION</h4>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="sms_notification" <?php echo e($general->sms_notification == "1" ? 'checked' : ''); ?>>
                            </div>
                            <div class="col-md-4">
                                <h4>JOB POST AUTO APPROVAL </h4>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="post_approve" <?php echo e($general->post_approve == "1" ? 'checked' : ''); ?>>
                            </div>
                        </div>
                        <div class="row">
                            <hr/>
                            <div class="col-md-12 ">
                                <button class="btn blue btn-block btn-lg">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>