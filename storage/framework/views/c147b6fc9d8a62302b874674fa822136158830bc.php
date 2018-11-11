<?php $__env->startSection('content'); ?>

  <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!--about us page content start-->
    <section class="section-padding about-us-page section-background" id="min-height-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $menu->description; ?>

                </div>
            </div>
        </div>
    </section>

  <script>
      (function($){
          $(window).on('resize',function(){
              var bodyHeight = $(window).height();
              $('#min-height-menu').css('min-height',parseInt(bodyHeight) - 500);
              console.log(bodyHeight)
          })
          var bodyHeight = $(window).height();
          $('#min-height-menu').css('min-height',parseInt(bodyHeight) - 500);
          console.log(bodyHeight)


      }(jQuery))
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>