<?php $__env->startSection('css'); ?>
    <style>
        table tr td {
            padding: 15px 10px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
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
                            <table class="table table-striped table-bordered table-hover" >
                                <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Total Bid</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($projects) > 0): ?>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="tr_<?php echo e($data->id); ?>">
                                            <td data-label="SL" class="black"><?php echo e(++$k); ?></td>
                                            <td data-label="Job Title">
                                                <?php $slug =  str_slug($data->title) ?>
                                                <h6><?php echo e(isset($data->title) ? $data->title : ''); ?></h6>
                                                <br>
                                                <small class="black">Expired date : <?php echo e(date( "d.m.Y", strtotime($data->deadline) )); ?>

                                                    <span class="padding-l-10 black">Last update : <?php echo e(date( "d.m.Y", strtotime($data->updated_at) )); ?></span>
                                                </small>
                                            </td>
                                            <td data-label="Salary" class="black"><?php echo e(isset($data->salary) ? $data->salary : ''); ?> <?php echo e($basic->currency); ?></td>
                                            <td data-label="Total Bid">
                                                <a href="<?php echo e(route('bid.Userlist',[$data->id, $slug])); ?>"
                                                   class="btn btn-info"><?php echo e($data->bids()->count()); ?></a>
                                            </td>
                                            <td data-label="Status">
                                                <?php if($data->deleted_at == null): ?>
                                                    <?php if($data->approve == 0): ?>
                                                        <button class="btn btn-warning btn-sm ">
                                                            Pending
                                                        </button>
                                                    <?php elseif($data->approve == 1): ?>
                                                        <button class="btn btn-success btn-sm ">
                                                            Approved
                                                        </button>
                                                    <?php elseif($data->approve == -1): ?>
                                                        <button class="btn btn-danger btn-sm">
                                                            Rejected
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </td>
                                            <td data-label="Action">
                                                <?php if($data->approve != -1): ?>
                                                    <a href="<?php echo e(route('edit.job',[$data->id, $slug])); ?>"
                                                       class="btn btn-info btn-sm" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <button data-toggle="modal" data-target="#small" value="3"
                                                        data-id="<?php echo e($data->id); ?>"
                                                        class="delete_button btn btn-danger btn-sm" title="Remove">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">You have no job post !!</td>
                                    </tr>

                                <?php endif; ?>
                                </tbody>
                            </table>
                            <?php echo $projects->links(); ?>

                        </div>
                    </div>

                </div>
                <!--end left column-->
            </div>
        </div>
    </div>
    <!-- Blog Single Section End -->
    <div class="clearfix"></div>



    <!-- Modal -->
    <div class="modal fade" role="dialog" id="small">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title"><i class="fa fa-trash"></i> Project Delete !</h6>
                </div>
                <div class="modal-body">
                    <p>Are you sure delete this ?</p>
                    <input type="hidden" id="confirm_id">

                </div>
                <div class="modal-footer">
                    <button type="button" id="confirm_delete" class="btn btn-primary" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete_button', function () {
                var id = $(this).data('id');
                $('#confirm_id').val(id);
                // alert(id);
            });

            $(document).on('click', '#confirm_delete', function () {
                var id = $('#confirm_id').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('job.delete')); ?>",
                    data: {
                        id: id,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 0) {
                            $('#tr_' + id).hide();
                            toastr.success(" Delete Successfully");
                        }
                    }
                    ,
                    error: function (res) {

                    }
                })
            });


        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>