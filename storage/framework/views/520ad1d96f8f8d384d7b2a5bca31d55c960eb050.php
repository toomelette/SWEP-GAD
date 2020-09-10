<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>Add Seminar</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="<?php echo e(route('dashboard.seminar.store')); ?>" enctype="multipart/form-data">

        <div class="box-body">

          <div class="col-md-12">
                  
            <?php echo csrf_field(); ?>    

            <?php echo __form::file(
             '4', 'doc_file', 'Attendance Sheet', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ); ?> 

            <?php echo __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title'), $errors->has('title'), $errors->first('title'), ''
            ); ?>


            <?php echo __form::textbox(
              '4', 'sponsor', 'text', 'Sponsor *', 'Sponsor', old('sponsor'), $errors->has('sponsor'), $errors->first('sponsor'), ''
            ); ?>


            <?php echo __form::textbox(
              '4', 'venue', 'text', 'Venue *', 'Venue', old('venue'), $errors->has('venue'), $errors->first('venue'), ''
            ); ?>


            <?php echo __form::datepicker(
              '4', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ); ?>


            <?php echo __form::datepicker(
              '4', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_to'), $errors->first('date_covered_to')
            ); ?>


          </div>



          
          <div class="col-md-12" style="padding-top:30px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Add Speakers</h3>
                <button id="add_row" type="button" class="btn btn-sm bg-green pull-right">Add Speaker &nbsp;<i class="fa fw fa-plus"></i></button>
              </div>
              
              <div class="box-body no-padding">
                
                <table class="table table-bordered">

                  <tr>
                    <th>Fullname *</th>
                    <th>Topic</th>
                    <th style="width: 40px"></th>
                  </tr>

                  <tbody id="table_body">


                    <?php if(old('row')): ?>

                      <?php $__currentLoopData = old('row'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                          <td>
                            <div class="form-group">
                              <input type="text" name="row[<?php echo e($key); ?>][spkr_fullname]" class="form-control" placeholder="Fullname" value="<?php echo e($value['spkr_fullname']); ?>">
                              <small class="text-danger"><?php echo e($errors->first('row.'. $key .'.spkr_fullname')); ?></small>
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <input type="text" name="row[<?php echo e($key); ?>][spkr_topic]" class="form-control" placeholder="Topic" value="<?php echo e($value['spkr_topic']); ?>">
                              <small class="text-danger"><?php echo e($errors->first('row.'. $key .'.spkr_topic')); ?></small>
                            </div>
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

</section>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('modals'); ?>

  <?php if(Session::has('SEMINAR_CREATE_SUCCESS')): ?>

    <?php echo __html::modal(
      'seminar_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SEMINAR_CREATE_SUCCESS')
    ); ?>

  
  <?php endif; ?>

<?php $__env->stopSection(); ?> 






<?php $__env->startSection('scripts'); ?>

  <script type="text/javascript">

    <?php if(Session::has('SEMINAR_CREATE_SUCCESS')): ?>
      $('#seminar_create').modal('show');
    <?php endif; ?>

    <?php echo __js::pdf_upload('doc_file', 'fa', ''); ?>



    
    $(document).ready(function() {
      $("#add_row").on("click", function() {
        var i = $("#table_body").children().length;
        var content ='<tr>' +
                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][spkr_fullname]" class="form-control" placeholder="Fullname">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][spkr_topic]" class="form-control" placeholder="Topic">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                            '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                        '</td>' +

                      '</tr>';
        $("#table_body").append($(content));
      });
    });


  </script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>