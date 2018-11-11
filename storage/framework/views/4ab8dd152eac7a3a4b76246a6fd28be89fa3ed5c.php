<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- Register Section Start -->
    <section class="register-section section-padding-form section-background section-bg-clr1" id="min-height-signup">
        <div class="container">
            <div class="row">


                <div class="col-md-8 col-md-offset-2">
                    <?php if($basic->registration == 1): ?>
                        <div class="login-admin">

                            <div class="login-form remove-margin-bottom">
                                <form method="POST" action="<?php echo e(route('register')); ?>">
                                    <?php echo csrf_field(); ?>

                                    <input type="text" name="name" placeholder="Enter Your Name / Company Name"
                                           class=" <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>">

                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback error-color red">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>

                                    <div class="margin-bottom-26"></div>
                                    <input type="text" name="username" placeholder="Username"
                                           class=" <?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>">

                                    <?php if($errors->has('username')): ?>
                                        <span class="invalid-feedback error-color red">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                    <div class="margin-bottom-26"></div>

                                    <input type="email" name="email" placeholder="Enter your E-mail"
                                           class="<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?> ">
                                    <div class="margin-bottom-26"></div>
                                    <?php if($errors->has('email')): ?>
                                        <span class=" error-color red">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>

                                    <input type="text" name="phone" placeholder="Contact Number"
                                           class="<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?> ">

                                    <?php if($errors->has('phone')): ?>
                                        <span class=" error-color red">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                    <div class="margin-bottom-26"></div>
                                    <input type="password" name="password"
                                           class="<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                           placeholder="Enter Password">

                                    <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback error-color red">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                    <div class="margin-bottom-26"></div>
                                    <input type="password" name="password_confirmation" placeholder="Re-Enter Password">

                                    <div class="margin-bottom-26"></div>
                                    <label class="type"><input type="radio" name="type" value="1" checked>
                                        Freelancer</label>
                                    <label class="type"><input type="radio" name="type" value="2"> Employer</label>

                                    <input type="submit" value="SIGN UP">
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="login-admin">
                            <div class="login-form remove-margin-bottom">
                                <h3 class="text-center text-danger ">Registration Has been Closed By Admin</h3>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Register Section End -->


    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-signup').css('min-height', parseInt(bodyHeight) - 450);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-signup').css('min-height', parseInt(bodyHeight) - 450);
            console.log(bodyHeight)


        }(jQuery))
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>