\

<?php $__env->startSection('css'); ?>

    <link href="<?php echo e(asset('assets/admin/css/bootstrap-fileinput.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- Blog Single Section Start -->
    <div class="blog-section blog-section2 section-padding section-background" id="min-height-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <aside>
                        <?php echo $__env->make('partials.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </aside>
                </div>
                <div class="col-md-12 col-sm-12 ">

                    <div class="login-admin login-admin">

                        <?php echo Form::open(['method'=>'post', 'role'=>'form','class'=>'form-horizontal','name' =>'editForm', 'files'=>true]); ?>


                        <div class="row">

                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Project Title :</strong></label>
                                    <div class="col-md-12">
                                        <input type="text" name="title"
                                               placeholder="Project Title ..."
                                               class="<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>">
                                        <?php if($errors->has('title')): ?>
                                            <span class="invalid-feedback error-color red">
                                                    <strong><?php echo e($errors->first('title')); ?></strong>
                                                </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Project Keywords :</strong></label>
                                    <div class="col-md-12">
                                        <input type="text" name="keywords"
                                               placeholder="Project Keywords ..."
                                               class="<?php echo e($errors->has('keywords') ? ' is-invalid' : ''); ?>">
                                        <?php if($errors->has('keywords')): ?>
                                            <span class="invalid-feedback error-color red">
                                                    <strong><?php echo e($errors->first('keywords')); ?></strong>
                                                </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <label class="col-md-12"><strong>Project Description :</strong>
                            </label>
                            <div class="col-md-12 ">
                                <div class="textColor white-bg">
                                    <textarea name="description" id="area1" rows="15"
                                              class="<?php echo e($errors->has('description') ? ' is-invalid' : ''); ?> form-control"> </textarea>
                                </div>

                                <?php if($errors->has('description')): ?>
                                    <span class="invalid-feedback error-color red">
                                        <strong><?php echo e($errors->first('description')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 "><strong>Experience :</strong></label>
                                    <div class="col-md-12">
                                        <input type="text"
                                               class="<?php echo e($errors->has('experience') ? ' is-invalid' : ''); ?>"
                                               name="experience">
                                        <?php if($errors->has('experience')): ?>
                                            <span class="invalid-feedback error-color red">
                                                    <strong><?php echo e($errors->first('experience')); ?></strong>
                                                </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Job Category :</strong></label>
                                    <div class="col-md-12">
                                        <select name="category_id">
                                            <option value="">Select Category</option>
                                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('category_id')): ?>
                                            <span class="invalid-feedback error-color red">
                                                    <strong><?php echo e($errors->first('category_id')); ?></strong>
                                                </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 "><strong>Job Salary
                                            :</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group input-group-md">
                                            <input type="text"
                                                   class="<?php echo e($errors->has('salary') ? ' is-invalid' : ''); ?>"
                                                   name="salary">
                                            <span class="input-group-addon">
                                              <?php echo e($basic->currency); ?>

                                            </span>
                                        </div>

                                        <?php if($errors->has('salary')): ?>
                                            <span class="invalid-feedback error-color red">
                                                    <strong><?php echo e($errors->first('salary')); ?></strong>
                                                </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 "><strong>Job Time
                                            :</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group input-group-md date" id="date"
                                             data-provide="datepicker">
                                            <input type="text" name="deadline" class=" form-control" required>
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail"
                                         style="width: 200px; height: 150px;"
                                         data-trigger="fileinput">
                                        <img style="width: 200px"
                                             src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Project Thumbnail"
                                             alt="...">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px"></div>

                                    <div class="img-input-div">
                                                <span class="btn btn-primary btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                                class="fa fa-file-image-o"></i> Select Thumbnail </span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                                class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image"
                                                           class="<?php echo e($errors->has('image') ? ' is-invalid' : ''); ?>"
                                                           accept="image/*">
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase"
                                           data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>

                                <?php if($errors->has('image')): ?>
                                    <span class="invalid-feedback error-color red">
                                        <strong><?php echo e($errors->first('image')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>


                            <div class="col-md-12">
                                <br>
                                <input type="submit" class="btn-block  btn btn-primary" value="SUBMIT JOB">
                            </div>
                        </div>
                        <?php echo Form::close(); ?>


                    </div>

                </div>
                <!--end left column-->

            </div>
        </div>
    </div>

    <!-- Blog Single Section End -->

    <div class="clearfix"></div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-fileinput.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/nicEdit-latest.js')); ?>"></script>
    <script>
        // $('.datepicker').datepicker();
        var date = new Date();
        date.setDate(date.getDate());

        $('#date').datepicker({
            startDate: date
        });

    </script>


    <script type="text/javascript">
        bkLib.onDomLoaded(function () {
            new nicEditor({fullPanel: true}).panelInstance('area1');
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>