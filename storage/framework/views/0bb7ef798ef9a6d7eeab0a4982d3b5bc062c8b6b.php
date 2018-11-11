<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-changpass">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        <?php echo $__env->make('partials.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                        <div class="login-admin login-admin1">
                                <div class="login-form remove-margin-bottom">
                                    <!-- BEGIN SAMPLE FORM PORTLET-->
                                    <form action="" method="post" role="form">
                                        <?php echo csrf_field(); ?>

                                        <input name="current_password"
                                               class="<?php echo e($errors->has('current_password') ? ' is-invalid' : ''); ?>"
                                               placeholder="Current Password" type="password">
                                        <?php if($errors->has('current_password')): ?>
                                            <span class="invalid-feedback error-color red">
                                <strong><?php echo e($errors->first('current_password')); ?></strong>
                            </span>
                                        <?php endif; ?>
                                        <div class="margin-bottom-26"></div>
                                        <input name="password" class="<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                               placeholder="New Password" type="password">
                                        <?php if($errors->has('password')): ?>
                                            <span class="invalid-feedback error-color red">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                                        <?php endif; ?>
                                        <div class="margin-bottom-26"></div>
                                        <input name="password_confirmation" placeholder="Confirm Password " type="password">
                                        <div class="margin-bottom-26"></div>

                                        <input type="submit" value="Change Password">
                                    </form>
                                </div>
                            </div><!---ROW-->

                </div>
                <!--end left column-->

            </div>
        </div>
    </div>


    <script>
        (function($){
            $(window).on('resize',function(){
                var bodyHeight = $(window).height();
                $('#min-height-changpass').css('min-height',parseInt(bodyHeight) - 650);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-changpass').css('min-height',parseInt(bodyHeight) - 650);
            console.log(bodyHeight)


        }(jQuery))
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if(session('message')): ?>

        <script type="text/javascript">

            $(document).ready(function () {

                swal("Success!", "<?php echo e(session('message')); ?>", "success");

            });

        </script>

    <?php endif; ?>



    <?php if(session('alert')): ?>

        <script type="text/javascript">

            $(document).ready(function () {

                swal("Sorry!", "<?php echo e(session('alert')); ?>", "error");

            });

        </script>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>