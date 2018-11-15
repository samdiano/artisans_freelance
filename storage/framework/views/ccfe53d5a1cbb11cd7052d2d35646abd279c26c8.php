<?php $__env->startSection('body'); ?>

    <?php
        $totalusers = \App\User::count();
       $banusers = \App\User::where('status',0)->count();
       $activeusers = \App\User::where('status',1)->count();

        $deposit =  App\Gateway::count();
        $depositLog =  App\Deposit::whereStatus(1)->count();
        $withdrawMethod =  App\WithdrawMethod::count();
        $withdrawLog =  App\WithdrawLog::where('status','!=',0)->count();
    ?>
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="page-title uppercase bold"> <?php echo e($page_title); ?>

            </h3>
            <hr>


            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-users"></i> USERS STATISTICS
                            </div>
                        </div>
                        <div class="portlet-body text-center">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup"
                                                      data-value="<?php echo e($totalusers); ?>"><?php echo e($totalusers); ?></span>
                                            </div>
                                            <div class="desc"> Total Users</div>
                                        </div>
                                        <a class="more" href="<?php echo e(route('users')); ?>"> View more
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat purple">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup"
                                                      data-value="<?php echo e($activeusers); ?>"><?php echo e($activeusers); ?></span>
                                            </div>
                                            <div class="desc"> Active Users</div>
                                        </div>
                                        <a class="more" href="<?php echo e(route('users')); ?>"> View more
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup"
                                                      data-value="<?php echo e($banusers); ?>"><?php echo e($banusers); ?></span>
                                            </div>
                                            <div class="desc"> Banned Users</div>
                                        </div>
                                        <a class="more" href="<?php echo e(route('user.ban')); ?>"> View more
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box purple">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-money"></i> DEPOSITS & WITHDRAW STATISTICS
                            </div>
                        </div>
                        <div class="portlet-body text-center">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup"
                                                      data-value="<?php echo e($deposit); ?>"><?php echo e($deposit); ?></span>
                                            </div>
                                            <div class="desc"> DEPOSIT METHODS</div>
                                        </div>
                                        <a class="more" href="<?php echo e(route('gateway')); ?>"> View more
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="dashboard-stat green">
                                        <div class="visual">
                                            <i class="fa fa-download"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup"
                                                      data-value="<?php echo e($depositLog); ?>"><?php echo e($depositLog); ?></span>
                                            </div>
                                            <div class="desc"> DEPOSIT LOGS</div>
                                        </div>
                                        <a class="more" href="<?php echo e(route('deposits')); ?>"> View more
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>

                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat purple">
                                        <div class="visual">
                                            <i class="fa fa-google-wallet"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup"
                                                      data-value="<?php echo e($withdrawMethod); ?>"><?php echo e($withdrawMethod); ?></span>
                                            </div>
                                            <div class="desc"> WITHDRAW METHODS</div>
                                        </div>
                                        <a class="more" href="<?php echo e(route('withdraw')); ?>"> View more
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>

                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat yellow">
                                        <div class="visual">
                                            <i class="fa fa-upload"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup"
                                                      data-value="<?php echo e($withdrawLog); ?>"><?php echo e($withdrawLog); ?></span>
                                            </div>
                                            <div class="desc"> WITHDRAW LOGS</div>
                                        </div>
                                        <a class="more" href="<?php echo e(route('withdraw.requests')); ?>"> View more
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>