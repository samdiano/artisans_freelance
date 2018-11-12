<style type="text/css">
    .breadcrumb-section {
        <?php $user = Auth::user() ?>

        <?php if(Auth::user()): ?>
            <?php if($user->cover != null ): ?>
                 background-image: url(<?php echo e(asset('assets/images/user/'.$user->cover)); ?>);
            <?php else: ?>
                 background-image: url(<?php echo e(asset('assets/images/logo/breadcrumb.jpg')); ?>);
            <?php endif; ?>
        <?php else: ?>
        background-image: url(<?php echo e(asset('assets/images/logo/breadcrumb.jpg')); ?>);
        <?php endif; ?>
    }

</style>
<!-- Breadcrumb Section start -->
<section class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- breadcrumb Section Start -->
                <div class="breadcrumb-content">
                    <h2><?php echo e($page_title); ?></h2>
                </div>
                <!-- Breadcrumb section End -->
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
