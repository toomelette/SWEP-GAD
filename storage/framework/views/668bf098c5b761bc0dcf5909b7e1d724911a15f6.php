<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?></h4>
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-md-3">
      <div class="well well-sm">
        <dl >
          <dt>Username:</dt>
          <dd><?php echo e($user->username); ?></dd>

          <dt>Last Name:</dt>
          <dd><?php echo e($user->lastname); ?></dd>

          <dt>First Name:</dt>
          <dd><?php echo e($user->firstname); ?></dd>

          <dt>Middle Name:</dt>
          <dd><?php echo e($user->middlename); ?></dd>

          <dt>Position:</dt>
          <dd><?php echo e($user->position); ?></dd>
          <hr class="sm-margin">

          <dt>Status:</dt>
          <dd>
            <?php if($user->is_online == 1): ?>
              <span class="label bg-green">ONLINE</span>
            <?php else: ?>
              <span class="label bg-gray">OFFLINE</span>
            <?php endif; ?>
          </dd>

          <dt>Account Status:</dt>
          <dd>
            <?php if($user->is_active == 1): ?>
              <span class="label bg-green">ACTIVE</span>
            <?php else: ?>
              <span class="label bg-red">INACTIVE</span>
            <?php endif; ?>
          </dd>
          <hr class="sm-margin">

          <dt>Last Login:</dt>
          <dd><?php echo e(date("M. d, Y | h:i A",strtotime($user->last_login_time))); ?></dd>

          <dt>Last Login Machine:</dt>
          <dd><?php echo e($user->last_login_machine); ?></dd>

        </dl>
      </div>
    </div>
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          User routes
        </div>
        <div class="panel-body">
          <?php if(($user->userMenu)->isEmpty()): ?>
            <div class="alert alert-info">
                No routes for this user.
            </div>
          <?php endif; ?>
          <?php $__currentLoopData = $user->userMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
            <?php if(!empty($menu->menu)): ?>
            <label>
              <?php echo e($menu->menu->name); ?>

            </label>
            <div class="row">
              <?php $__currentLoopData = $user->userSubmenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($submenu->subMenuContent) && !empty($menu->menu)): ?>
                  <?php if($menu->menu->menu_id == $submenu->subMenuContent->menu_id): ?>
                    <div class="col-md-4">
                       <li>
                        <?php echo e(str_replace($menu->menu->name, '', $submenu->subMenuContent->name)); ?>

                      </li>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <hr class="sm-margin">

          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <div class="row">
    <?php echo __html::timestamp($user ,"4"); ?>

    <div class="col-md-4">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>