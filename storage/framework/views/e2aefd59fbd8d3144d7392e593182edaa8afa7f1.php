<?php $__env->startSection('body'); ?>
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> <?php echo e($page_title); ?>


            </h3>
            <hr>
            <div class="portlet light bordered">
                <div class="portlet-title pull-right">
                    <a href="<?php echo e(route('send.mail.subscriber')); ?>" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-envelope"></i> Send Email For Subscribers
                    </a>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Email</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$mac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$k); ?></td>
                                    <td><?php echo e($mac->email); ?></td>
                                    <td>
                                        <b class="btn btn-sm btn-<?php echo e($mac->status ==0 ? 'warning' : 'success'); ?>"><?php echo e($mac->status == 0 ? 'Deactive' : 'Active'); ?></b>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary btn-sm edit_button"
                                                data-toggle="modal" data-target="#myModal"
                                                data-act="Edit"
                                                data-status="<?php echo e($mac->status); ?>"
                                                data-id="<?php echo e($mac->id); ?>">
                                            <i class="fa fa-edit"></i> EDIT
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>




    <!-- Modal for Edit button -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"> Action </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="post" action="<?php echo e(route('update.subscriber')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control abir_id" type="hidden" name="id">

                    </div>
                    <div class="form-group">
                        <select name="status" id="event-status" class="form-control input-lg abir_status" required>
                            <option value="">Status</option>
                            <option value="1">Active</option>
                            <option value="0">Blocked</option>
                        </select>
                        <br>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $(document).on("click", '.edit_button', function (e) {
                var status = $(this).data('status');
                var id = $(this).data('id');
                var act = $(this).data('act');
                $(".abir_id").val(id);
                $(".abir_status").val(status).attr('selected', 'selected');
                $(".abir_act").text(act);
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>