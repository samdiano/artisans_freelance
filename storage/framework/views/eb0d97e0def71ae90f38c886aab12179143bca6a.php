

<?php $__env->startSection('body'); ?>
	<div class="page-content-wrapper">
		<div class="page-content">

			<h3 class="page-title uppercase bold"> <?php echo e($page_title); ?>


			</h3>
			<hr>
			<div class="portlet light bordered">
				<div class="portlet-title green">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold uppercase">Email Template</span>
					</div>
					<div class="tools"></div>
				</div>
				<div class="portlet-body">
					<div class="table-scrollable">
						<table class="table table-striped table-hover">
							<thead>
							<tr>
								<th> # </th>
								<th> CODE </th>
								<th> DESCRIPTION </th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td> 1 </td>
								<td> <pre>&#123;&#123;message&#125;&#125;</pre> </td>
								<td> Details Text From Script</td>
							</tr>
							<tr>
								<td> 2 </td>
								<td> <pre>&#123;&#123;name&#125;&#125;</pre> </td>
								<td> Users Name. Will Pull From Database and Use in EMAIL text</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-12">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-envelope font-blue-sharp"></i>
								<span class="caption-subject font-blue-sharp bold uppercase">Email and SMS Template</span>
							</div>
						</div>
						<div class="portlet-body form">
							<form role="form" method="POST" action="<?php echo e(route('template.update')); ?>" enctype="multipart/form-data">
								<?php echo e(csrf_field()); ?>

								<div class="form-body">
									<div class="form-group">
										<label>Email Sent Form</label>
										<input type="email" name="esender" class="form-control input-lg" value="<?php echo e($temp->esender); ?>">
									</div>

									<div class="form-group">
										<label>Email Message</label>
										<textarea class="form-control" name="emessage" id="emessage" rows="10">
									<?php echo e($temp->emessage); ?>

								</textarea>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn green btn-block btn-lg">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script src="<?php echo e(asset('assets/admin/js/nicEdit-latest.js')); ?>" type="text/javascript"></script>
	<script type="text/javascript">
        new nicEditor().panelInstance('emessage');
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>