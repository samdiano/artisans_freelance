
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/table.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> <?php echo e($page_title); ?>


            </h3>
            <hr>
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <button id="btn_add" name="btn_add" class="btn btn-primary pull-right bold"><i class="fa fa-plus"></i> Add New Social</button>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Link</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">
                        <?php $__currentLoopData = $social; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="product<?php echo e($product->id); ?>">
                                <td data-label="Id"><?php echo e($product->id); ?></td>
                                <td data-label="Name"><?php echo e($product->name); ?></td>
                                <td data-label="Code"><?php echo $product->code; ?></td>
                                <td data-label="Link"><?php echo e($product->link); ?></td>
                                <td data-label="Action">
                                    <button class="btn btn-primary btn-detail open_modal bold uppercase" value="<?php echo e($product->id); ?>"><i class="fa fa-edit"></i> EDIT</button>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button" data-toggle="modal" data-target="#DelModal" data-id="<?php echo e($product->id); ?>"> <i class='fa fa-trash'></i> DELETE</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i> Manage Social</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Name : </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error bold " id="name" name="name" placeholder="Social Name" value="">
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Icon Code : </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error bold " id="code" name="code" placeholder="Social Fontawesome Code" value="">
                                <code>For Fontawesome code visit : http://fontawesome.io/icons/</code>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Link : </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error bold " id="link" name="link" placeholder="Social Link" value="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Save Social</button>
                    <input type="hidden" id="product_id" name="product_id" value="0">
                </div>
            </div>

    </div>
    <meta name="_token" content="<?php echo csrf_token(); ?>" />
    <!-- Modal for DELETE -->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete !</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" class="form-inline">
                        <input type="hidden" name="delete_id" id="delete_id" class="delete_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="button" class="btn btn-danger deleteButton"><i class="fa fa-trash"></i> DELETE</button>
                    </form>
                </div>

            </div>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

    <script>
        $(document).ready(function () {
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $("#delete_id").val(id);
            });
        });
        var url = '<?php echo e(url('/admin/manage-social')); ?>';
        //display modal form for product editing
        $(document).on('click','.open_modal',function(){
            var product_id = $(this).val();

            $.get(url + '/' + product_id, function (data) {
                //success data
                console.log(data);
                $('#product_id').val(data.id);
                $('#name').val(data.name);
                $('#code').val(data.code);
                $('#link').val(data.link);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            })
        });
        //display modal form for creating new product
        $('#btn_add').click(function(){
            $('#btn-save').val("add");
            $('#frmProducts').trigger("reset");
            $('#myModal').modal('show');
        });
        //create new product / update existing product
        $("#btn-save").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            e.preventDefault();
            var formData = {
                name: $('#name').val(),
                code: $('#code').val(),
                link: $('#link').val(),
            }
            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var product_id = $('#product_id').val();;
            var my_url = url;
            if (state == "update"){
                type = "PUT"; //for updating existing resource
                my_url += '/' + product_id;
            }
            console.log(formData);
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var product = '<tr id="product' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td style="font-size: 22px;">' + data.code + '</td><td>' + data.link + '</td>';
                    product += '<td><button class="btn btn-primary btn-detail open_modal bold uppercase" value="' + data.id + '"><i class="fa fa-edit"></i> EDIT</button>';
                    product += '<button type="button" class="btn btn-danger bold uppercase delete_button" data-toggle="modal" data-target="#DelModal" data-id='+ data.id +'> <i class="fa fa-trash"></i> DELETE</button></td></tr>';

                    if (state == "add"){ //if user added a new record
                        $('#products-list').append(product);
                    }else{ //if user updated an existing record
                        $("#product" + product_id).replaceWith( product );
                    }
                    $('#frmProducts').trigger("reset");
                    $('#myModal').modal('hide')
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            }).done(function() {
                swal('Success','Successfully Social Saved.','success');
            });
        });
        //delete product and remove it from list
        $(document).ready(function () {
            $(document).on('click','.deleteButton',function(e){

                var product_id = document.getElementById("delete_id").value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                $.ajax({
                    type: "DELETE",
                    url: url + '/' + product_id,
                    success: function (data) {
                        $('#DelModal').modal('hide');
                        $("#product" + product_id).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                }).done(function() {
                    swal('Success','Successfully Social Deleted.','success');
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>