<?php
    $user = Auth::id();
      $msg =  App\Message::where('receiver_id',$user)->where('is_read',0)->distinct()->get(['bit_job_id']);
?>

<div class="custom-menu list-group list-group-horizontal">

    <a href="<?php echo e(route('user.messages')); ?>" class="list-group-item  <?php if(request()->path() == 'user/messages'): ?> active <?php endif; ?> "><span class="fab fa-facebook-messenger  padding-r-5"  <?php if(request()->path() != 'user/messages'): ?> style="color: #585756" <?php else: ?>  style="color: #fff" <?php endif; ?> ></span>  Messages <?php if(count($msg)>0): ?> (<?php echo e($msg->count()); ?>) <?php endif; ?></a>
    <?php if(Auth::user()->type ==1): ?>
    <a href="<?php echo e(route('edit.resume')); ?>" class="list-group-item"> + <span class="glyphicon glyphicon-user padding-r-5"></span> Edit Resume</a>
        <?php
            $user = Auth::user();
                $newJob = App\AssignJob::where('user_id', $user->id)->whereStatus(0)->where('notify',0)->count();
        ?>

        <a href="<?php echo e(route('activeJobList')); ?>" class="list-group-item">
            <span class="glyphicon glyphicon-briefcase padding-r-5"></span>
            My Jobs <?php if($newJob>0): ?><span class="badge badge-info badge-button"><?php echo e($newJob); ?> new</span><?php endif; ?>
        </a>
    <?php elseif(Auth::user()->type ==2): ?>
        <a href="<?php echo e(route('manage.job')); ?>" class="list-group-item  <?php if(request()->path() == 'user/manage-job'): ?> active <?php endif; ?> "><span class="glyphicon glyphicon-briefcase padding-r-5"></span>  Manage  Jobs</a>

        <a href="<?php echo e(route('add.job')); ?>" class="list-group-item  <?php if(request()->path() == 'user/add-job'): ?> active <?php endif; ?>"><span class="glyphicon glyphicon-plus padding-r-5"></span>  Post New Job</a>
        <a href="<?php echo e(route('assign.list')); ?>" class="list-group-item  <?php if(request()->path() == 'user/awarded-list'): ?> active <?php endif; ?>"><span class="glyphicon glyphicon-bookmark padding-r-5"></span> Job Awarded List</a>
        <a href="<?php echo e(route('user.trx')); ?>" class="list-group-item  <?php if(request()->path() == 'user/transaction-log'): ?> active <?php endif; ?>"><span class="glyphicon glyphicon-edit padding-r-5"></span>  Transactions</a>
    <?php endif; ?>
</div>

