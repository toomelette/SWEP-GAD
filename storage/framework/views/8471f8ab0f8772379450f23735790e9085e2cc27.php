<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo e(asset('images/avatar.jpeg')); ?>" class="img-circle" alt="User Image">
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



      
      <?php if(!$global_user_menus_u->isEmpty()): ?>

          <li class="header">NAVIGATION</li>
          <?php $__currentLoopData = $global_user_menus_u; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($user_menu->is_menu == true): ?>

              <?php if($user_menu->is_dropdown == false): ?>

              <li class="<?php echo Route::currentRouteNamed($user_menu->route) ? 'active' : ''; ?>">
                <a href="<?php echo e(route($user_menu->route)); ?>">
                  <i class="fa <?php echo e($user_menu->icon); ?>"></i> <span><?php echo e($user_menu->name); ?></span>
                </a>
              </li>

              <?php else: ?>

                <li class="treeview <?php echo Route::currentRouteNamed($user_menu->route) ? 'active' : ''; ?>">
                  <a href="#">
                    <i class="fa <?php echo e($user_menu->icon); ?>"></i> <span><?php echo e($user_menu->name); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                    <ul class="treeview-menu">

                      <?php $__currentLoopData = $user_menu->userSubMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($user_nav->is_nav == true): ?>

                          <li class="<?php echo Route::currentRouteNamed($user_nav->route) ? 'active' : ''; ?>">
                            <a href="<?php echo e(route($user_nav->route)); ?>"><i class="fa fa-caret-right"></i> <?php echo e($user_nav->nav_name); ?></a>
                          </li>

                        <?php endif; ?>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </li>

              <?php endif; ?>

            <?php endif; ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>




        
        <?php if(!$global_user_menus_su->isEmpty()): ?>

          <li class="header">SUPER USER</li>
          <?php $__currentLoopData = $global_user_menus_su; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($user_menu->is_menu == true): ?>

              <?php if($user_menu->is_dropdown == false): ?>

              <li class="<?php echo Route::currentRouteNamed($user_menu->route) ? 'active' : ''; ?>">
                <a href="<?php echo e(route($user_menu->route)); ?>">
                  <i class="fa <?php echo e($user_menu->icon); ?>"></i> <span><?php echo e($user_menu->name); ?></span>
                </a>
              </li>

              <?php else: ?>

                <li class="treeview <?php echo Route::currentRouteNamed($user_menu->route) ? 'active' : ''; ?>">
                  <a href="#">
                    <i class="fa <?php echo e($user_menu->icon); ?>"></i> <span><?php echo e($user_menu->name); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                    <ul class="treeview-menu">

                      <?php $__currentLoopData = $user_menu->userSubMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($user_nav->is_nav == true): ?>

                          <li class="<?php echo Route::currentRouteNamed($user_nav->route) ? 'active' : ''; ?>">
                            <a href="<?php echo e(route($user_nav->route)); ?>"><i class="fa fa-caret-right"></i> <?php echo e($user_nav->nav_name); ?></a>
                          </li>

                        <?php endif; ?>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </li>

              <?php endif; ?>

            <?php endif; ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>




        
        <?php if(!$global_user_menus_sgrlab->isEmpty()): ?>

          <li class="header">SUGAR LABORATORY</li>
          <?php $__currentLoopData = $global_user_menus_sgrlab; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($user_menu->is_menu == true): ?>

              <?php if($user_menu->is_dropdown == false): ?>

              <li class="<?php echo Route::currentRouteNamed($user_menu->route) ? 'active' : ''; ?>">
                <a href="<?php echo e(route($user_menu->route)); ?>">
                  <i class="fa <?php echo e($user_menu->icon); ?>"></i> <span><?php echo e($user_menu->name); ?></span>
                </a>
              </li>

              <?php else: ?>

                <li class="treeview <?php echo Route::currentRouteNamed($user_menu->route) ? 'active' : ''; ?>">
                  <a href="#">
                    <i class="fa <?php echo e($user_menu->icon); ?>"></i> <span><?php echo e($user_menu->name); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                    <ul class="treeview-menu">

                      <?php $__currentLoopData = $user_menu->userSubMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($user_nav->is_nav == true): ?>

                          <li class="<?php echo Route::currentRouteNamed($user_nav->route) ? 'active' : ''; ?>">
                            <a href="<?php echo e(route($user_nav->route)); ?>"><i class="fa fa-caret-right"></i> <?php echo e($user_nav->nav_name); ?></a>
                          </li>

                        <?php endif; ?>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </li>

              <?php endif; ?>

            <?php endif; ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>




        
        <?php if(!$global_user_menus_regu->isEmpty()): ?>

          <li class="header">REGULATION</li>
          <?php $__currentLoopData = $global_user_menus_regu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($user_menu->is_menu == true): ?>

              <?php if($user_menu->is_dropdown == false): ?>

              <li class="<?php echo Route::currentRouteNamed($user_menu->route) ? 'active' : ''; ?>">
                <a href="<?php echo e(route($user_menu->route)); ?>">
                  <i class="fa <?php echo e($user_menu->icon); ?>"></i> <span><?php echo e($user_menu->name); ?></span>
                </a>
              </li>

              <?php else: ?>

                <li class="treeview <?php echo Route::currentRouteNamed($user_menu->route) ? 'active' : ''; ?>">
                  <a href="#">
                    <i class="fa <?php echo e($user_menu->icon); ?>"></i> <span><?php echo e($user_menu->name); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                    <ul class="treeview-menu">

                      <?php $__currentLoopData = $user_menu->userSubMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($user_nav->is_nav == true): ?>

                          <li class="<?php echo Route::currentRouteNamed($user_nav->route) ? 'active' : ''; ?>">
                            <a href="<?php echo e(route($user_nav->route)); ?>"><i class="fa fa-caret-right"></i> <?php echo e($user_nav->nav_name); ?></a>
                          </li>

                        <?php endif; ?>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </li>

              <?php endif; ?>

            <?php endif; ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>


          
      <?php endif; ?>

    </ul>
  </section>
</aside>