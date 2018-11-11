
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!--Contact Section-->
    <section class="contact-section contact-section1 section-padding section-background" id="min-height-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--Contact Info Tabs-->
                    <div class="contact-info">
                        <div class="row ">
                            <!-- contact-content Start -->
                            <div class="col-md-4">
                                <div class="contact-content">
                                    <div class="contact-header contact-form">
                                        <h2 class="white">Get In Touch</h2>
                                    </div>
                                    <div class="contact-list">
                                        <ul>
                                            <li>
                                                <div class="contact-thumb"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                <div class="contact-text">
                                                    <p class="white">Address:<span class="white"><?php echo e($basic->address); ?></span></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="contact-thumb"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                                <div class="contact-text">
                                                    <p class="white">Call Us :<span class="white"><?php echo e($basic->phone); ?></span></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="contact-thumb"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                <div class="contact-text">
                                                    <p class="white">Mail Us :<span class="white"><?php echo e($basic->email); ?></span></p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- contact-content End -->
                            <!--Form Column-->
                            <div class="form-column col-md-8 col-sm-12 login-admin login-admin1">
                                <!-- Contact Form -->
                                <div class="contact-form ">
                                    <h2 class="white">Send Message Us</h2>

                                    <form action="<?php echo e(route('contact-submit')); ?>" method="post">
                                        <?php echo csrf_field(); ?>

                                        <div class="row clearfix">
                                            <div class="col-md-6  col-xs-12 form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                                                <input type="text" name="name" placeholder="Your Name*" required>
                                                <?php if($errors->has('name')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-md-6  col-xs-12 form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                <input type="email" name="email" placeholder="Email Address*" required>
                                                <?php if($errors->has('email')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class=" col-md-12   form-group<?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
                                                <textarea name="message" placeholder="Your Message..." required></textarea>
                                                <?php if($errors->has('message')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('message')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class=" col-md-12 form-group">
                                                <button class="theme-btn btn-style-one" type="submit" name="submit-form">Send Message</button>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                                <!--End Comment Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Contact Section-->


    <script>
        (function($){
            $(window).on('resize',function(){
                var bodyHeight = $(window).height();
                $('#min-height-contact').css('min-height',parseInt(bodyHeight) - 450);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-contact').css('min-height',parseInt(bodyHeight) - 450);
            console.log(bodyHeight)


        }(jQuery))
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>