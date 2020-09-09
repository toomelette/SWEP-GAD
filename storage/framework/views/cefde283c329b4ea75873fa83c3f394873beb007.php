<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>Add User</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form id="user_create_form" class="form-horizontal" method="POST" autocomplete="off" action="<?php echo e(route('dashboard.user.store')); ?>">

        <div class="box-body">

          <div class="col-md-11">
                  
              <?php echo csrf_field(); ?>

              <?php echo __form::textbox_inline(
                  'firstname', 'text', 'Firstname *', 'Firstname', old('firstname'), $errors->has('firstname'), $errors->first('firstname'), 'data-transform="uppercase"'
              ); ?>


              <?php echo __form::textbox_inline(
                  'middlename', 'text', 'Middlename *', 'Middlename', old('middlename'), $errors->has('middlename'), $errors->first('middlename'), 'data-transform="uppercase"'
              ); ?>


              <?php echo __form::textbox_inline(
                  'lastname', 'text', 'Lastname *', 'Lastname', old('lastname'), $errors->has('lastname'), $errors->first('lastname'), 'data-transform="uppercase"'
              ); ?>


              <?php echo __form::textbox_inline(
                  'email', 'email', 'Email *', 'Email', old('email'), $errors->has('email'), $errors->first('email'), ''
              ); ?>


              <?php echo __form::textbox_inline(
                  'position', 'text', 'Position *', 'Position / Plantilla', old('position'), $errors->has('position'), $errors->first('position'), 'data-transform="uppercase"'
              ); ?>


              <?php echo __form::textbox_inline(
                  'username', 'text', 'Username *', 'Username', old('username'), $errors->has('username') || Session::has('USER_CREATE_FAIL_USERNAME_EXIST'), $errors->first('username'), ''
              ); ?>


              <?php echo __form::password_inline(
                  'password', 'Password *', 'Password', $errors->has('password'), $errors->first('password'), ''
              ); ?>


              <?php echo __form::password_inline(
                  'password_confirmation', 'Confirm Password *', 'Confirm Password', '', '', ''
              ); ?>


          </div>


          
          <div class="col-md-12" style="padding-top:50px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">User Menu</h3>
                <button id="add_row" type="button" class="btn btn-sm bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
              </div>
              
              <div class="box-body no-padding">
                
                <table class="table table-bordered">

                  <tr>
                    <th>Menus *</th>
                    <th>Menu Modules</th>
                    <th style="width: 40px"></th>
                  </tr>

                  <tbody id="table_body">

                    <?php if(old('menu')): ?>
                      
                      <?php $__currentLoopData = old('menu'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                          <td style="width:450px;">
                            <select name="menu[]" id="menu" class="form-control select2" style="width: 90%;">
                              <option value="">Select</option>
                              <?php $__currentLoopData = $global_menus_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                  <option value="<?php echo e($data->menu_id); ?>" <?php echo old('menu.'.$key) == $data->menu_id ? 'selected' : ''; ?>><?php echo e($data->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <br><small class="text-danger"><?php echo e($errors->first('menu.'.$key)); ?></small>
                          </td>

                          <td style="min-width:50px; min-width:50px; max-width:50px">
                            <select name="submenu[]" id="submenu" class="form-control select2" multiple="multiple" data-placeholder="Modules" style="width: 80%;">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $global_submenus_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(old('submenu') && $data->menu_id == old('menu.'.$key)): ?>
                                        <option value="<?php echo e($data->submenu_id); ?>" <?php echo in_array($data->submenu_id, old('submenu')) ? 'selected' : ''; ?>><?php echo e($data->name); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo e($data->submenu_id); ?>"><?php echo e($data->name); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </td>

                          <td>
                            <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                          </td>

                        </tr>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>

                    </tbody>
                </table>
               
              </div>

            </div>
          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('modals'); ?>

  <?php if(Session::has('USER_CREATE_SUCCESS')): ?>

    <?php echo __html::modal(
      'user_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('USER_CREATE_SUCCESS')
    ); ?>


  <?php endif; ?>

<?php $__env->stopSection(); ?> 





<?php $__env->startSection('scripts'); ?>

  <script type="text/javascript">

  <?php echo __js::show_password('password', 'show_password'); ?>

  <?php echo __js::show_password('password_confirmation', 'show_password_confirmation'); ?>

  

  <?php if(Session::has('USER_CREATE_SUCCESS')): ?>
    $('#user_create').modal('show');
  <?php endif; ?>

  
  $('select').select2({ dropdownParent: $('#table_body') });

  
  $(document).ready(function() {
    $("#add_row").on("click", function() {
        $('select').select2('destroy');
        var content ='<tr>' +
                      '<td style="width:450px;">' +
                        '<select name="menu[]" id="menu" class="form-control select2" style="width:90%;">' +
                          '<option value="">Select</option>' +
                          '<?php $__currentLoopData = $global_menus_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>' +
                            '<option value="<?php echo e($data->menu_id); ?>"><?php echo e($data->name); ?></option>' +
                          '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>' +
                        '</select>' +
                      '</td>' +

                      '<td>' +
                        '<select name="submenu[]" id="submenu" class="form-control select2" multiple="multiple" data-placeholder="Modules" style="width:80%;">' +
                          '<option value="">Select</option>' +
                          '<?php $__currentLoopData = $global_submenus_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>' +
                              '<option value="<?php echo e($data->submenu_id); ?>"><?php echo e($data->name); ?></option>' +
                          '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>' +
                        '</select>' +
                      '</td>' +

                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +
                    '</tr>';

      $("#table_body").append($(content));
      $('select').select2({width:400});
      $('select').select2({ dropdownParent: $('#table_body') });
    });
  });





  
  $(document).ready(function() {
    $(document).on("change", "#menu", function() {
        var key = $(this).val();
        var parent = $(this).closest('tr');
        console.log(parent);
        if(key) {
            $.ajax({
                headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                url: "/api/submenu/select_submenu_byMenuId/" + key,
                type: "GET",
                dataType: "json",
                success:function(data) {   

                    $(parent).find("#submenu").empty();

                    $.each(data, function(key, value) {
                        $(parent).find("#submenu").append("<option value='" + value.submenu_id + "'>"+ value.name +"</option>");
                    });

                    $(parent).find("#submenu").append("<option value>Select</option>");
        
                }
            });
        }else{
            $(parent).find("#submenu").empty();
        }
    });
  });





  
  // $(document).on("change", "#employee_sync", function () {

  //   var key = $(this).val();

  //   if(key){
  //     $.ajax({
  //       headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
  //       url: "/api/user/response_from_employee/"+key,
  //       type: "GET",
  //       dataType: "json",
  //       success:function(data) {       
            
  //         $.each(data, function(key, value) {

  //           $("#user_create_form").find("input").not("input[name=_token]").val("");
  //           $("#user_create_form").find("input").not("input[name=_token]").removeAttr("readonly");

  //           if(value.firstname != ''){
  //             $("#user_create_form #firstname").val(value.firstname).attr("readonly", true);
  //           }

  //           if(value.middlename != ''){
  //             $("#user_create_form #middlename").val(value.middlename).attr("readonly", true);
  //           }

  //           if(value.lastname != ''){
  //             $("#user_create_form #lastname").val(value.lastname).attr("readonly", true);
  //           }

  //           if(value.email != ''){
  //             $("#user_create_form #email").val(value.email).attr("readonly", true);
  //           }

  //           if(value.position != ''){
  //             $("#user_create_form #position").val(value.position).attr("readonly", true);
  //           }
          
  //         });

  //       }
  //     });
  //   }else{
  //     $("#user_create_form").find("input").not("input[name=_token]").val("");
  //     $("#user_create_form").find("input").not("input[name=_token]").removeAttr("readonly");
  //   }
    
  // });




</script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>