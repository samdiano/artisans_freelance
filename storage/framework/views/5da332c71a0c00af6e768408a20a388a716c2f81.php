<?php $__env->startSection('content'); ?>


    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section class="about-section section-padding-2 section-bg-clr1" id="min-height-trx">
        <div class="container">

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <aside>
                        <?php echo $__env->make('partials.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <?php echo e($page_title); ?>

                            </div>
                        </div>

                        <div class="portlet-body">
                            <table class="table table-striped table-bordered ">
                                <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col" style="width: 25%">Details</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col" >Remaining Balance</th>
                                    <th scope="col">Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($invests) > 0): ?>
                                    <?php $__currentLoopData = $invests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr <?php if($data->type == '+'): ?> class="greenbg"
                                            <?php elseif($data->type == '-'): ?> class="redbg" <?php endif; ?>>
                                            <td data-label="SL"><?php echo e(++$k); ?></td>
                                            <td data-label="#TRX"><?php echo e(isset($data->trx) ? $data->trx : 'N/A'); ?></td>
                                            <td data-label="Details"><?php echo isset($data->title) ? $data->title : 'N/A'; ?></td>
                                            <td data-label="Amount"><?php echo isset($data->amount) ? $data->amount : 'N/A'; ?> <?php echo $basic->currency; ?></td>
                                            <td data-label="Remeaning Balance"><?php echo isset($data->	main_amo) ? $data->	main_amo : 'N/A'; ?> <?php echo $basic->currency; ?></td>
                                            <td data-label="Time"><?php echo date('d M y h:i A',strtotime($data->created_at)); ?> </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">No Data Found !!</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                            <?php echo $invests->links(); ?>

                        </div>
                    </div>
                </div>
                <!--end left column-->
            </div>

        </div>
    </section>
    <!-- About Hostonion End -->



    <script>
        (function ($) {
            $(window).on('resize', function () {
                var bodyHeight = $(window).height();
                $('#min-height-trx').css('min-height', parseInt(bodyHeight) - 650);
                console.log(bodyHeight)
            })
            var bodyHeight = $(window).height();
            $('#min-height-trx').css('min-height', parseInt(bodyHeight) - 650);
            console.log(bodyHeight)


        }(jQuery))
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>