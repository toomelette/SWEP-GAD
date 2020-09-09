<header class="main-header">
  <a href="#" class="logo">
    <span class="logo-mini">G</span>
    <span class="logo-lg"><b>GAD</b></span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo __html::check_img(Auth::user()->image); ?>" class="user-image" alt="User Image">
            <?php if(Auth::check()): ?>
              <?php echo e(__sanitize::html_encode(Auth::user()->firstname)); ?>

            <?php endif; ?>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="<?php echo __html::check_img(Auth::user()->image); ?>" class="img-circle" alt="User Image">
              <p>
                <?php if(Auth::check()): ?>
                  <?php echo e(__sanitize::html_encode(Auth::user()->firstname) .' '. __sanitize::html_encode(Auth::user()->lastname)); ?>

                  <small><?php echo e(__sanitize::html_encode(Auth::user()->position)); ?></small>
                <?php endif; ?>
                
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo e(route('dashboard.profile.details')); ?>" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a  href="<?php echo e(route('auth.logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="btn btn-default btn-flat">Sign out</a>
              </div>
              <form id="frm-logout" action="<?php echo e(route('auth.logout')); ?>" method="POST" style="display: none;">
                <?php echo e(csrf_field()); ?>

              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>