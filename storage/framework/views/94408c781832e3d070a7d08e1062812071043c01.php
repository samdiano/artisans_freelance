<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!--faq page content start-->
    <section class="faq-section section-padding section-background " id="min-height-faq">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="faq">
                        <div class="container">
                            <div class="faq-content">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="domainsTab">
                                        <div class="panel-group accordion" id="accordion4" >
                                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="panel panel-default  active faqmar">
                                                    <div class="panel-heading" role="tabpanel">

                                                        <h4 class="panel-title"> <a href="#domainsTabQ<?php echo e($f->id); ?>"  style="color: #fff" role="button" data-toggle="collapse" data-parent="#accordion4"   aria-expanded="false"class="collapsed "> <?php echo e($f->title); ?> <i class="fa fa-minus"></i> </a></h4>
                                                    </div>
                                                    <div id="domainsTabQ<?php echo e($f->id); ?>" class="panel-collapse collapse <?php if($k == 0): ?> in <?php endif; ?>" role="tabpanel" <?php if($k == 0): ?> aria-expanded="true" <?php else: ?>  aria-expanded="false"  <?php endif; ?>   <?php if($k == 0): ?> class="height-173" <?php else: ?>  class="height-173"<?php endif; ?>>
                                                        <div class="panel-body secondery">
                                                           <?php echo $f->description; ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
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
                $('#min-height-faq').css('min-height',parseInt(bodyHeight) - 450);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-faq').css('min-height',parseInt(bodyHeight) - 450);
            console.log(bodyHeight)


        }(jQuery))
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>