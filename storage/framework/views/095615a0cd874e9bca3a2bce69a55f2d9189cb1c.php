<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRA Web Portal - RD</title>
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.png')); ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->make('layouts.css-plugins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('css'); ?>

  </head>
  <body class="hold-transition <?php echo Auth::check() ? __sanitize::html_encode(Auth::user()->color) : ''; ?>" style="zoom:90%;">

    <div id="loader"></div>

    <div class="wrapper">

      <?php echo $__env->make('layouts.admin-topnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <?php echo $__env->make('layouts.admin-sidenav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

      <div class="content-wrapper" style="height:500em;"> 

        <?php echo $__env->yieldContent('content'); ?>

      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.2.0
        </div>
        <strong>Copyright &copy; 2019-2020 <a href="#">MIS-VISAYAS</a>.</strong> All rights
        reserved.
      </footer>

    </div>

    <?php echo $__env->make('layouts.js-plugins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->yieldContent('modals'); ?>

    <?php echo $__env->yieldContent('scripts'); ?>

  </body>

</html>