<form id="edit_menu_form" autocomplete="off" data="<?php echo e($menu->slug); ?>">
  <?php echo csrf_field(); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="fa <?php echo e($menu->icon); ?>"></i> <?php echo e($menu->name); ?></h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <?php echo __form::textbox(
        '12 name', 'name', 'text', 'Name: *', 'Name',$menu->name, '', '', ''
      ); ?>


      <?php echo __form::textbox(
        '12 route', 'route', 'text', 'Route: *', 'Route',$menu->route, '', '', ''
      ); ?>


      <?php echo __form::textbox(
        '12 category', 'category', 'text', 'Category: *', 'Category',$menu->category, '', '', ''
      ); ?>


      <?php echo __form::textbox_icon(
        '12 icon', 'icon', 'text', 'Icon: *', 'Icon',$menu->icon, '', '', ''
      ); ?>


      <?php echo __form::select_static(
        '6 is_menu', 'is_menu', 'Is menu: *', $menu->is_menu, [
          'No' => '0',
          'Yes' => '1',             
        ], '', '', '', ''
      ); ?>


      <?php echo __form::select_static(
        '6 is_dropdown', 'is_dropdown', 'Is dropdown: *',$menu->is_dropdown, [
          'No' => '0',
          'Yes' => '1',             
        ], '', '', '', ''
      ); ?>

    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    <button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?>"> <i class="fa fa-save"></i> Save</button>
  </div>
</form>