<?php $__env->startSection('form-open'); ?>
  <form id="edit_mill_district_form" autocomplete="off" data="<?php echo e($mill_district->slug); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
  <?php echo e($mill_district->mill_district); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
  <div class="row">
    <?php echo csrf_field(); ?>
    <?php echo __form::select_static(
            '12 location', 'location', 'Location *', $mill_district->location, 
              $locations
            , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
    ); ?>


    <?php echo __form::select_static(
      '12 region', 'region', 'Region *', 
      $mill_district->region, 
      $regions_under_location
      , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
    ); ?>


    <?php echo __form::textbox(
      '12 mill_district', 'mill_district', 'text', 'Mill District *', 'Mill District', $mill_district->mill_district, '', $errors->first('title'), 'style="text-transform: uppercase"'
    ); ?>


    <?php echo __form::textbox(
      '12 chairman', 'chairman', 'text', 'Chairman *', 'Chairman', $mill_district->chairman, '', $errors->first('title'), ''
    ); ?>


    <?php echo __form::textbox(
      '12 address', 'address', 'text', 'Address *', 'Address', $mill_district->address, '', $errors->first('title'), ''
    ); ?>


    <?php echo __form::textbox(
      '12 mdo', 'mdo', 'text', 'Mill District Officer *', 'Mill District Officer', $mill_district->mdo, '', $errors->first('title'), ''
    ); ?>


    <?php echo __form::textbox(
      '12 phone', 'phone', 'text', 'Contact number *', 'Contact number', $mill_district->phone, '', $errors->first('title'), ''
    ); ?>


  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?> add_block_farm_btn"><i class="fa fa-save"> </i> Save</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form-close'); ?>
  </form>
<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('layouts.modal-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>