<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- Login Section Start -->
    <section class="register-section section-padding-form section-background" >
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="login-admin login-admin1" id="min-height-responive">
                        
                        
                        <div class="login-form remove-margin-bottom">
                            <form method="POST" action="<?php echo e(route('login')); ?>">
                                <?php echo csrf_field(); ?>

                                <input type="text" name="username"
                                       class="<?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>"
                                       value="<?php echo e(old('username')); ?>" placeholder=" Username">
                                <?php if($errors->has('username')): ?>
                                    <span class="invalid-feedback red">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <div class="margin-bottom-26"></div>
                                <input type="password" name="password" placeholder="Password"
                                       class="<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>">
                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback red">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <div class="margin-bottom-26"></div>
                                <input type="submit" value="Login">

                                <a href="<?php echo e(route('password.request')); ?>">Forget Password ??</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
    (function($){
        $(window).on('resize',function(){
            var bodyHeight = $(window).height();
            $('#min-height-responive').css('min-height',parseInt(bodyHeight) - 650);
            console.log(bodyHeight)
        })
        var bodyHeight = $(window).height();
        $('#min-height-responive').css('min-height',parseInt(bodyHeight) - 650);
        console.log(bodyHeight)


    }(jQuery))
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>