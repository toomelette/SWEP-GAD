<?php $__env->startSection('content'); ?>

<section class="content">
	<div class="col-md-3"></div>
	<div class="col-md-6">

		<?php if(Session::has('AUTH_AUTHENTICATED')): ?>
			<?php echo __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('AUTH_AUTHENTICATED')); ?>

		<?php endif; ?>

		<?php if(Session::has('AUTH_UNACTIVATED')): ?>
			<?php echo __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('AUTH_UNACTIVATED')); ?>

		<?php endif; ?>

		<?php if(Session::has('CHECK_UNAUTHENTICATED')): ?>
			<?php echo __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_UNAUTHENTICATED')); ?>

		<?php endif; ?>

		<?php if(Session::has('CHECK_NOT_ACTIVE')): ?>
			<?php echo __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_NOT_ACTIVE')); ?>

		<?php endif; ?>

		<?php if(Session::has('PROFILE_UPDATE_USERNAME_SUCCESS')): ?>
			<?php echo __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('PROFILE_UPDATE_USERNAME_SUCCESS')); ?>

		<?php endif; ?>

		<?php if(Session::has('PROFILE_UPDATE_PASSWORD_SUCCESS')): ?>
			<?php echo __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('PROFILE_UPDATE_PASSWORD_SUCCESS')); ?>

		<?php endif; ?>

		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Login</h3>
			</div>
			<form class="form-horizontal" method="POST" action="<?php echo e(route('auth.login')); ?>">
				
				<?php echo csrf_field(); ?>
				<div class="box-body">
					<div class="form-group <?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
						<label for="username" class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input class="form-control is-invalid" name="username" id="username" placeholder="Username" type="text" value="<?php echo e(__sanitize::html_attribute_encode(old('username'))); ?>">
							
							<?php if($errors->has('username')): ?>
							<span class="help-block"> <?php echo e($errors->first('username')); ?> </span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
						<label for="password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input class="form-control" name="password" id="password" placeholder="Password" type="password">
							<?php if($errors->has('password')): ?>
							<span class="help-block"><?php echo e($errors->first('password')); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
				
				<div class="box-footer">
					<button type="submit" class="btn btn-default">Sign in</button>
				</div>
				
			</form>
		</div>

	</div>
	<div class="col-md-3"></div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>