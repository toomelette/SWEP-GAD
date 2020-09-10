<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo __html::check_img(Auth::user()->image); ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        
        <?php if(Auth::check()): ?>
          <p><?php echo e(Auth::user()->firstname); ?></p>
        <?php endif; ?>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      

      <?php if(Auth::check()): ?>

      
        <?php if(!$global_user_menus->isEmpty()): ?>
            <li class="header">NAVIGATION</li>

            <?php $__currentLoopData = $global_user_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(!empty($user_menu->menu->is_menu)): ?>
                <?php if($user_menu->menu->is_menu == true): ?>
                 <?php if($user_menu->menu->is_dropdown == false): ?>
                  <li class="<?php echo Route::currentRouteNamed($user_menu->menu->route) ? 'active' : ''; ?>">
                    <a href="<?php echo e(route($user_menu->menu->route)); ?>">
                      <i class="fa <?php echo e($user_menu->menu->icon); ?>"></i> <span><?php echo e($user_menu->menu->name); ?></span>
                    </a>
                  </li>
                  <?php else: ?>
                    <li class="treeview <?php echo Route::currentRouteNamed($user_menu->menu->route) ? 'active' : ''; ?>">
                      <a href="#">
                        <i class="fa <?php echo e($user_menu->menu->icon); ?>"></i> <span><?php echo e($user_menu->menu->name); ?></span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>

                        <ul class="treeview-menu">

                          <?php $__currentLoopData = $user_menu->userSubMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($user_nav->subMenu)): ?>
                              <?php if($user_nav->subMenu->is_nav == true): ?>

                                <li class="<?php echo Route::currentRouteNamed($user_nav->subMenu->route) ? 'active' : ''; ?>">
                                  <a href="<?php echo e(route($user_nav->subMenu->route)); ?>"><i class="fa fa-caret-right"></i> <?php echo e($user_nav->subMenu->nav_name); ?></a>
                                </li>

                              <?php endif; ?>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                    </li>         
                  <?php endif; ?>
                <?php else: ?>
              <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           

          <?php endif; ?>


            
        <?php endif; ?>

    </ul>
  </section>
</aside>