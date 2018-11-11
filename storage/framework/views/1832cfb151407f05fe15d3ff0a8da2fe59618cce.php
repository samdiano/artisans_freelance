<?php $__env->startSection('content'); ?>
    <style type="text/css">
        .breadcrumb-section {
            background-image: url(<?php echo e(asset('assets/images/logo/breadcrumb.jpg')); ?>);
        }
        .vh{
            height: 70vh;
        }
        .display-center-bread{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

        }

    </style>
    <!-- Breadcrumb Section start -->
    <section class="breadcrumb-section " >
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- breadcrumb Section Start -->
                    <div class="display-center-bread vh">
                    <div class="breadcrumb-content">
                        <?php
                        $page_title = 404
                        ?>
                        <h2><?php echo e($page_title); ?></h2>
                        <p style="color: white">Page Not Found!!</p>
                    </div>
                    </div>
                    <!-- Breadcrumb section End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>