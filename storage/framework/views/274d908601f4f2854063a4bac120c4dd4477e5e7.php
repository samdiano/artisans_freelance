<!--footer area start-->
<footer class="footer-area">

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <p class="copyright-text ">
                        <?php echo $basic->copyright; ?>

                    </p>
                </div>
                <div class="col-md-3 col-sm-9">
                    <div class="footer-menu">
                        <ul>
                            <?php $__currentLoopData = $social; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li> <a href="<?php echo e(url($data->link)); ?>" style="font-size: 18px"><?php echo $data->code; ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="back-to-top" class="scroll-top back-to-top" data-original-title="" title="" >
        <i class="fa fa-angle-up"></i>
    </div>
</footer>