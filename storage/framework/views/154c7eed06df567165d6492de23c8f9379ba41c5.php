<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/front/css/job-list.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($basic->sitename); ?> | Search</title>

    <!--Favicon add-->
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/images/logo/favicon.png')); ?>"/>
    <!--bootstrap Css-->
    <link href="<?php echo e(asset('assets/front/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(asset('assets/front/css/components-rounded.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/plugins.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/layout.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/default.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
          integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!--font-awesome Css-->
    <link href="<?php echo e(asset('assets/front/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!--Swiper  Css-->
    <link href="<?php echo e(asset('assets/front/css/swiper.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/toastr.min.css')); ?>" rel="stylesheet">

    <!--Style Css-->
    <link href="<?php echo e(asset('assets/front/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/custom.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/front/css/table.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('css'); ?>
    <script src="<?php echo e(asset('assets/admin/js/sweetalert.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/sweetalert.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/front/css/style.php')); ?>?color=<?php echo e($basic->color); ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('assets/front/css/bg_color.php')); ?>?bg_color=<?php echo e($basic->bg_color); ?>">
    <link href="<?php echo e(asset('assets/front/css/responsive.css')); ?>" rel="stylesheet">

    <script src="<?php echo e(asset('assets/front/js/jquery.js')); ?>"></script>
</head>

<body>


<!--loader-->
<div id="preloader">
    <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    </div>
</div>
<!--loader-->
<?php echo $__env->make('partials.bell-notify', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<header>
    <!-- Header bottom start -->
    <div class="header-bottom header header-wrapper">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand " href="<?php echo e(route('homepage')); ?>"><img
                                        src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" alt="logo"></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav" id="header-menu">

                                <?php
                                    $user = Auth::user();
                                    $userSlug = str_slug($user->name);
                                    $newJob = App\AssignJob::where('user_id', $user->id)->whereStatus(0)->where('notify',0)->count();
                                ?>
                                <?php if($user->type == 2): ?>
                                <li style="background:#f1f1f1;">
                                        <a style="background:#ecf0f1;" data-toggle="modal" data-target="#myModal">
                                                <span class="glyphicon glyphicon-search"></span>
                                        </a>
                                </li>
                                <?php endif; ?>
                                <li><a href="<?php echo e(route('home')); ?>"> <?php if(Auth::user()->type == 1): ?> Recent Jobs <?php else: ?> Looking For An
                                        Expert <?php endif; ?></a></li>


                                <li><a href="<?php echo e(route('edit-profile')); ?>"> Dashboard</a></li>

                                <?php if($user->type == 1): ?>
                                    <li>
                                        <a href="<?php echo e(route('activeJobList')); ?>"> My Jobs
                                            <?php if($newJob>0): ?> <span class="badge badge-info badge-button"><?php echo e($newJob); ?> new</span><?php endif; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if($user->type == 2): ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-haspopup="true" aria-expanded="false"> My Projects <i
                                                    class='fa fa-sort-desc'></i></a>
                                        <ul class="dropdown-menu mega-menu mega-menu1 mega-menu2 withd2"
                                            style=" border: none;">
                                            <li class="mega-list mega-list1 ">
                                                <a href="<?php echo e(route('add.job')); ?>"> Post New Job</a>
                                                <a href="<?php echo e(route('manage.job')); ?>"> Manage  Jobs</a>
                                                <a href="<?php echo e(route('assign.list')); ?>"> Job Awarded List</a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-haspopup="true" aria-expanded="false"> DEPOSIT <i
                                                    class='fa fa-sort-desc'></i></a>
                                        <ul class="dropdown-menu mega-menu mega-menu1 mega-menu2 withd"
                                            style=" border: none;">
                                            <li class="mega-list mega-list1 ">
                                                <a href="<?php echo e(route('deposit')); ?>"> DEPOSIT MONEY</a>
                                                <a href="<?php echo e(route('user.depositLog')); ?>"> DEPOSIT LOG</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if($user->type == 1): ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-haspopup="true" aria-expanded="false"> WITHDRAW <i
                                                    class='fa fa-sort-desc'></i></a>
                                        <ul class="dropdown-menu mega-menu mega-menu1 mega-menu2 withd"
                                            style=" border: none;">
                                            <li class="mega-list mega-list1 ">
                                                <a href="<?php echo e(route('withdraw.money')); ?>">WITHDRAW NOW</a>
                                                <a href="<?php echo e(route('user.withdrawLog')); ?>">WITHDRAW LOG</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false"> <strong> <?php echo e(Auth::user()->username); ?>

                                            <i class='fa fa-sort-desc'></i></strong></a>
                                    <ul class="dropdown-menu mega-menu mega-menu1 mega-menu2" style=" border: none;">
                                        <li class="mega-list mega-list1 ">

                                            <a href="<?php echo e(route('biography',[$user->id,$userSlug])); ?>"> Public Profile </a>
                                            <a href="<?php echo e(route('user.trx')); ?>">Transaction Log </a>
                                            <?php if(Auth::user()->type == 1): ?>
                                                <a href="<?php echo e(route('edit.resume')); ?>">Edit Resume / CV </a>
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('user.change-password')); ?>">Change Password </a>
                                            <div>
                                                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> Log Out</a>

                                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                                      style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </div>

                                        </li>
                                    </ul>
                                </li>


                            </ul>

                        </div><!-- /.navbar-collapse -->

                    </div>
                </div>
            </div>
        </nav><!-- nav -->
    </div>
    <!-- header-bottom end -->
</header>

<div class="container">
        <?php if(isset($details)): ?>
        <h4 style="color:#116fff; margin-top:2%;"> This is/are the search results for your query <b> <?php echo e($query); ?> </b></h4>
        <div style="background:#f9f9f9;">
                <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $biography = str_slug($user->name)
                ?>
                
                    <?php if($user->image != null): ?>
                        <img style="margin-left:2%; margin-top:2%;" width="150" src="<?php echo e(asset('assets/images/user/'.$user->image)); ?>" alt="image"
                                class="img-responsive img-rounded">
                    <?php else: ?>
                        <img style="margin-left:2%;margin-top:2%;" width="150" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text= Profile"
                                alt="image" class="img-responsive img-rounded">
                    <?php endif; ?>
                    <div style="margin-bottom:2%;margin-left:2%;">
                    <h5 style="padding-top:2%;" ><a href="<?php echo e(route('biography',[$user->id, $biography])); ?>"><?php echo e(isset($user->username) ? $user->username : '-'); ?></a></b>
                    <div class="label badge-highlight"><?php echo e(isset($user->category_id) ? $user->category_id : ' '); ?></div>
                    </div>
                    <a style="width:80%; margin-left:10%;" href="<?php echo e(route('biography',[$user->id, $biography])); ?>"
                        class="btn btn-primary btn-sm btn-block">View Profile
                    </a><hr />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <p style="padding:4%;" class="text-center">No result was found for your search</p>
        </div>
        <div class="col-md-3"></div>
        <?php endif; ?>
        
    </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Search for freelancers</h4>
            </div>
            <div class="modal-body">
                <form action="/search" method="POST" role="search">
                <?php echo e(csrf_field()); ?>

                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search For Freelancers"><br/>
                    <input type="submit" value="Search" class="btn btn-default">
                </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      
        </div>
      </div>
<!-- header section end -->
<div class="clearfix"></div>

<?php echo $__env->yieldContent('content'); ?>


<!--footer area start-->
<?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<!--Bootstrap v3 script load here-->
<script src="<?php echo e(asset('assets/front/js/bootstrap.min.js')); ?>"></script>
<!--Swiper script load-->
<script src="<?php echo e(asset('assets/front/js/swiper.min.js')); ?>"></script>
<!--CounterUp script load-->
<script src="<?php echo e(asset('assets/front/js/jquery.counterup.min.js')); ?>"></script>
<!--WayPoints script load-->
<script src="<?php echo e(asset('assets/front/js/waypoints.min.js')); ?>"></script>
<!--Jquery Ui Slider script load-->
<script src="<?php echo e(asset('assets/front/js/jquery-ui-slider.min.js')); ?>"></script>
<!-- Highlight script load-->
<script src="<?php echo e(asset('assets/front/js/highlight.min.js')); ?>"></script>
<!--RainDrops script load-->
<script src="<?php echo e(asset('assets/front/js/toastr.min.js')); ?>"></script>

<?php echo $__env->yieldContent('script'); ?>

<!--Main js file load-->
<script src="<?php echo e(asset('assets/front/js/main.js')); ?>"></script>

<?php echo $__env->yieldContent('js'); ?>

<?php if(session('success')): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            swal("Success!", "<?php echo e(session('success')); ?>", "success");
        });
    </script>
<?php endif; ?>

<?php if(session('alert')): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            swal("Sorry!", "<?php echo e(session('alert')); ?>", "error");
        });
    </script>
<?php endif; ?>

<script type="text/javascript">
            <?php if(Session::has('message')): ?>
    var type = "<?php echo e(Session::get('alert-type','info')); ?>";
    switch (type) {
        case 'info':
            toastr.info("<?php echo e(Session::get('message')); ?>");
            break;

        case 'warning':
            toastr.warning("<?php echo e(Session::get('message')); ?>");
            break;

        case 'success':
            toastr.success("<?php echo e(Session::get('message')); ?>");
            break;

        case 'error':
            toastr.error("<?php echo e(Session::get('message')); ?>");
            break;

    }
    <?php endif; ?>

    $('body').click(function () {
        $('.single-notification-item .dropdown-notification').css({
            'visibility': 'hidden',
            'opacity': '0',
            'z-index': '0'
        });
    });
    $(document).on('click', '.single-notification-item', function () {
        $(this).children('.dropdown-notification').css({
            'visibility': 'visible',
            'opacity': '1',
            'z-index': '999999'
        });
        // alert()
    })
</script>
</body>
</html>

