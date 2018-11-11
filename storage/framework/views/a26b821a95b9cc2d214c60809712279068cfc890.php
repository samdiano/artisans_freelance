<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section class="section-padding section-background section-bg-clr1" id="min-height-deposit">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $gates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title"><?php echo e($gate->name); ?></h4>
                            </div>
                            <div class="panel-body text-center bg-black">
                                <img src="<?php echo e(asset('assets/images/gateway')); ?>/<?php echo e($gate->id); ?>.jpg" style="width:100%">
                            </div>
                            <div class="panel-footer bg-black bdr-top">
                                <button class="btn btn-primary btn-block bg-sky" data-toggle="modal"
                                        data-target="#depositModal<?php echo e($gate->id); ?>"> <strong>Deposit Now</strong>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--Buy Modal -->
                    <div id="depositModal<?php echo e($gate->id); ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Deposit via <strong><?php echo e($gate->name); ?></strong></h4>
                                </div>

                                <form method="post" action="<?php echo e(route('deposit.data-insert')); ?>">
                                    <div class="modal-body">
                                        <?php echo e(csrf_field()); ?>


                                        <input type="hidden" name="gateway" value="<?php echo e($gate->id); ?>">
                                        <label class="col-md-12"><strong class="text-uppercase">DEPOSIT AMOUNT</strong>
                                            <span class="black">(<?php echo e($gate->minamo); ?> - <?php echo e($gate->maxamo); ?>) <?php echo e($basic->currency); ?>

                                                <br>
                                                Charged <?php echo e($gate->fixed_charge); ?> <?php echo e($basic->currency); ?> + <?php echo e($gate->percent_charge); ?>

                                                %</span>
                                        </label>
                                        <hr/>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="amount" class="form-control input-lg" id="amount"
                                                       placeholder=" Enter Amount" required>
                                                <span class="input-group-addon"><?php echo e($basic->currency); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary ">Preview</button>
                                        <button type="button" class="btn btn-default " data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <script>
        (function($){
            $(window).on('resize',function(){
                var bodyHeight = $(window).height();
                $('#min-height-deposit').css('min-height',parseInt(bodyHeight) - 650);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-deposit').css('min-height',parseInt(bodyHeight) - 650);
            console.log(bodyHeight)


        }(jQuery))
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>