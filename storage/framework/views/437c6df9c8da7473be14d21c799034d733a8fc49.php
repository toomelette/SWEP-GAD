<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRA Web Portal - GAD</title>
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <?php echo $__env->make('layouts.css-plugins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  </head>
  <body class="hold-transition skin-purple layout-top-nav">
    <div class="wrapper">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="#" class="navbar-brand"><b>SRA WEB PORTAL - GAD</b></a>
            </div>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="notifications-menu"><a href="#">Login</a></li>
                <li class="notifications-menu"><a href="#">Info </a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="content-wrapper">
        <div class="container">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>
      <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.2.0
          </div>
          <strong>Copyright &copy; 2019-2020 <a href="#">MIS-VISAYAS</a>.</strong> All rights
          reserved.
        </div>
      </footer>
      
    </div>

    <?php echo $__env->make('layouts.js-plugins', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <script type="text/javascript">
      
      <?php echo $__env->yieldContent('scripts'); ?>

    </script>
    

  </body>
</html>