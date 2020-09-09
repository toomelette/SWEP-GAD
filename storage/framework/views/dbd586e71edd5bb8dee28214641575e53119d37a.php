<?php

  $table_sessions = [ 
                      Session::get('CJ_ANALYSIS_CREATE_SUCCESS_SLUG'),
                      Session::get('CJ_ANALYSIS_UPDATE_SUCCESS_SLUG'),
                    ];

?>



<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>Fill Up Results</h1>
    <div class="pull-right" style="margin-top: -25px;">
      <?php echo __html::back_button(['dashboard.sugar_analysis.index', 'dashboard.sugar_analysis.show']); ?>

    </div>
</section>

<section class="content" id="pjax-container">


  <div class="col-md-12">
    <div class="box">
      
      <div class="box-header with-border">
        <h3 class="box-title">Cane Juice Analysis</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
        <div class="box-body">


          
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"><b>Set OR No.</b></h3>
              </div>
              
              <form method="POST" action="<?php echo e(route('dashboard.sugar_analysis.set_or_no', $sugar_analysis->slug)); ?>" autocomplete="off">

              <?php echo csrf_field(); ?>

                <div class="box-body">

                  <?php echo csrf_field(); ?>
                  
                  <?php echo __form::textbox(
                     '3', 'or_no', 'or_no', 'OR No. *', 'OR No.', old('or_no') ? old('or_no') : $sugar_analysis->or_no, $errors->has('or_no'), $errors->first('or_no'), ''
                  ); ?>


                  <div class="col-md-2" style="margin-top: 25px;">
                    <button type="submit" class="btn btn-default">Set <i class="fa fa-fw fa-save"></i></button>
                  </div>

                </div> 

              </form>
                
            </div>
          </div>

          
          <div class="col-md-12">
            <?php if(Session::has('CJA_NUM_OF_SAMPLES_ERROR')): ?>
              <?php echo __html::alert('error', '<i class="icon fa fa-info"></i> Note!', Session::get('CJA_NUM_OF_SAMPLES_ERROR')); ?>

            <?php endif; ?>
          </div>   


            
          
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"><b>Form</b></h3>
              </div>
              
              <form data-pjax role="form" method="POST" action="<?php echo e(route('dashboard.sugar_analysis.cane_juice_analysis_store', $sugar_analysis->slug)); ?>" autocomplete="off">

                <?php echo csrf_field(); ?>

                <div class="box-body">

                  <?php echo __form::textbox(
                     '4', 'entry_no', 'entry_no', 'Entry No. ', 'Entry No.', old('entry_no'), $errors->has('entry_no'), $errors->first('entry_no'), ''
                  ); ?>



                  <?php echo __form::datepicker(
                    '4', 'date_submitted',  'Date Submitted', old('date_submitted'), $errors->has('date_submitted'), $errors->first('date_submitted')
                  ); ?>



                  <?php echo __form::datepicker(
                    '4', 'date_sampled',  'Date Sampled', old('date_sampled'), $errors->has('date_sampled'), $errors->first('date_sampled')
                  ); ?>


                  <div class="col-md-12"></div>

                  <?php echo __form::textbox(
                     '4', 'date_analyzed', 'date_analyzed', 'Date Analyzed', 'Date Analyzed', old('date_analyzed'), $errors->has('date_analyzed'), $errors->first('date_analyzed'), ''
                  ); ?>


                  <?php echo __form::textbox(
                     '4', 'variety', 'variety', 'Variety', 'Variety', old('variety'), $errors->has('variety'), $errors->first('variety'), ''
                  ); ?>



                  <?php echo __form::textbox(
                     '4', 'hacienda', 'hacienda', 'Hacienda', 'Hacienda', old('hacienda'), $errors->has('hacienda'), $errors->first('hacienda'), ''
                  ); ?>


                  <div class="col-md-12"></div>


                  <?php echo __form::textbox(
                     '4', 'corrected_brix', 'corrected_brix', 'Corrected Brix ', 'Corrected Brix', old('corrected_brix'), $errors->has('corrected_brix'), $errors->first('corrected_brix'), ''
                  ); ?>


                  <?php echo __form::textbox(
                     '4', 'polarization', 'polarization', '% Pol', '% Pol', old('polarization'), $errors->has('polarization'), $errors->first('polarization'), ''
                  ); ?>


                  <?php echo __form::textbox(
                     '4', 'purity', 'purity', 'Purity', 'Purity', old('purity'), $errors->has('purity'), $errors->first('purity'), ''
                  ); ?>


                  <div class="col-md-12"></div>

                  <?php echo __form::textbox(
                     '4', 'remarks', 'remarks', 'Remarks PSTC/LkgTC', 'Remarks PSTC/LkgTC', old('remarks'), $errors->has('remarks'), $errors->first('remarks'), ''
                  ); ?>


                </div> 

              <div class="box-footer">
                <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
              </div>

              </form>

            </div>

          </div>


          
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"><b>List</b></h3>
                <div class="box-tools">
                  <a href="<?php echo e(route('dashboard.sugar_analysis.cane_juice_analysis_print', $sugar_analysis->slug)); ?>" class="btn btn-sm btn-default" target="_blank">
                    <i class="fa fa-print"></i> Print
                  </a>
                </div>
              </div>
              
              <div class="box-body">
                <?php if($errors->all()): ?>
                  <ul style="line-height: 10px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><p class="text-danger"><?php echo e($data); ?></p></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                <?php endif; ?>
                <table class="table table-hover">
                  <tr>
                    <th>Entry No.</th>
                    <th>Date Submitted</th>
                    <th>Date Sampled</th>
                    <th>Date Analyzed</th>
                    <th>Variety</th>
                    <th>Hacienda</th>
                    <th>Corrected Brix</th>
                    <th>% POL</th>
                    <th>Purity</th>
                    <th>Remarks</th>
                    <th>Action</th>
                  </tr>
                  <?php $__currentLoopData = $sugar_analysis->caneJuiceAnalysis->sortBy('entry_no'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <tr 
                      <?php echo __html::table_highlighter( $data->slug, $table_sessions); ?> 
                      <?php echo old('e_slug') == $data->slug ? 'style="background-color: #F5B7B1;"' : ''; ?>

                    >
                      <td><?php echo e($data->entry_no); ?></td>
                      <td><?php echo e(__dataType::date_parse($data->date_submitted, 'm/d/Y')); ?></td>
                      <td><?php echo e(__dataType::date_parse($data->date_sampled, 'm/d/Y')); ?></td>
                      <td><?php echo e($data->date_analyzed); ?></td>
                      <td><?php echo e($data->variety); ?></td>
                      <td><?php echo e($data->hacienda); ?></td>
                      <td><?php echo e($data->corrected_brix); ?></td>
                      <td><?php echo e($data->polarization); ?></td>
                      <td><?php echo e($data->purity); ?></td>
                      <td><?php echo e($data->remarks); ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="#" id="cja_update_btn" es="<?php echo e($data->slug); ?>" data-url="<?php echo e(route('dashboard.sugar_analysis.cane_juice_analysis_update', [$sugar_analysis->slug, $data->slug])); ?>" class="btn btn-sm btn-default">
                            <i class="fa fa-pencil-square-o"></i>
                          </a>
                          <a href="#" id="cja_delete_btn" data-url="<?php echo e(route('dashboard.sugar_analysis.cane_juice_analysis_destroy', [$sugar_analysis->slug, $data->slug])); ?>" class="btn btn-sm btn-default">
                            <i class="fa  fa-trash-o"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>

              </div> 

            </div>
          </div>


          



        </div>

      </div>
    </div>


</section>

<?php $__env->stopSection(); ?>






<?php $__env->startSection('modals'); ?>


  
  <div class="modal fade bs-example-modal-lg" id="cja_update" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" id="cja_update_body">
          <form data-pjax id="cja_update_form" method="POST" autocomplete="off">

            <div class="row">
                
              <?php echo csrf_field(); ?>

              <input name="_method" value="PUT" type="hidden">

              <input name="e_slug" id="e_slug"  type="hidden">

              <?php echo __form::textbox(
                 '4', 'e_entry_no', 'e_entry_no', 'Entry No. ', 'Entry No.', old('e_entry_no'), $errors->has('e_entry_no'), $errors->first('e_entry_no'), ''
              ); ?>



              <?php echo __form::datepicker(
                '4', 'e_date_submitted',  'Date Submitted', old('e_date_submitted'), $errors->has('e_date_submitted'), $errors->first('e_date_submitted')
              ); ?>



              <?php echo __form::datepicker(
                '4', 'e_date_sampled',  'Date Sampled', old('e_date_sampled'), $errors->has('e_date_sampled'), $errors->first('e_date_sampled')
              ); ?>


              <div class="col-md-12"></div>

              <?php echo __form::textbox(
                 '4', 'e_date_analyzed', 'e_date_analyzed', 'Date Analyzed', 'Date Analyzed', old('e_date_analyzed'), $errors->has('e_date_analyzed'), $errors->first('e_date_analyzed'), ''
              ); ?>



              <?php echo __form::textbox(
                 '4', 'e_variety', 'e_variety', 'Variety', 'Variety', old('e_variety'), $errors->has('e_variety'), $errors->first('e_variety'), ''
              ); ?>



              <?php echo __form::textbox(
                 '4', 'e_hacienda', 'e_hacienda', 'Hacienda', 'Hacienda', old('e_hacienda'), $errors->has('e_hacienda'), $errors->first('e_hacienda'), ''
              ); ?>


              <div class="col-md-12"></div>


              <?php echo __form::textbox(
                 '4', 'e_corrected_brix', 'e_corrected_brix', 'Corrected Brix ', 'Corrected Brix', old('e_corrected_brix'), $errors->has('e_corrected_brix'), $errors->first('e_corrected_brix'), ''
              ); ?>



              <?php echo __form::textbox(
                 '4', 'e_polarization', 'e_polarization', '% Pol', '% Pol', old('e_polarization'), $errors->has('e_polarization'), $errors->first('e_polarization'), ''
              ); ?>


              <?php echo __form::textbox(
                 '4', 'e_purity', 'e_purity', 'Purity', 'Purity', old('e_purity'), $errors->has('e_purity'), $errors->first('e_purity'), ''
              ); ?>


              <div class="col-md-12"></div>

              <?php echo __form::textbox(
                 '12', 'e_remarks', 'e_remarks', 'Remarks PSTC/LkgTC', 'Remarks PSTC/LkgTC', old('e_remarks'), $errors->has('e_remarks'), $errors->first('e_remarks'), ''
              ); ?>



            </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>
        </form>
      </div>
    </div>
  </div>


  
  <?php echo __html::modal_delete('cja_delete'); ?>


<?php $__env->stopSection(); ?> 







<?php $__env->startSection('scripts'); ?>

  <script type="text/javascript">


    // Edit Button Action
    $(document).on("click", "#cja_update_btn", function () {

      var slug = $(this).attr("es");

      $("#cja_update").modal("show");
      $("#cja_update_body #cja_update_form").attr("action", $(this).data("url"));

      // Datepicker
      $('.datepicker').each(function(){
          $(this).datepicker({
              autoclose: true,
              dateFormat: "mm/dd/yy",
              orientation: "bottom"
          })
      });

      $.ajax({
        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        url: "/api/sugar_analysis/cane_juice_analysis/"+slug+"/edit",
        type: "GET",
        dataType: "json",
        success:function(data) {       
            
          $.each(data, function(key, value) {
            $("#cja_update_form #e_slug").val(value.slug);
            $("#cja_update_form #e_entry_no").val(value.entry_no);
            if(value.date_sampled != null){
              $("#cja_update_form #e_date_sampled").datepicker("setDate", new Date(value.date_sampled));
            }
            if(value.date_submitted != null){
              $("#cja_update_form #e_date_submitted").datepicker("setDate", new Date(value.date_submitted));
            }
            $("#cja_update_form #e_date_analyzed").val(value.date_analyzed);
            $("#cja_update_form #e_variety").val(value.variety);
            $("#cja_update_form #e_hacienda").val(value.hacienda);
            $("#cja_update_form #e_corrected_brix").val(value.corrected_brix);
            $("#cja_update_form #e_polarization").val(value.polarization);
            $("#cja_update_form #e_purity").val(value.purity);
            $("#cja_update_form #e_remarks").val(value.remarks);
          });

        }
      });

    });



    // Update Form Action
    $(document).on("submit", "#cja_update_body #cja_update_form", function () {
      $('#cja_update').delay(50).fadeOut(50);
      setTimeout(function(){
        $('#cja_update').modal("hide");  
      }, 100);
    });



    // Delete Button Action
    $(document).on("click", "#cja_delete_btn", function () {
      $("#cja_delete").modal("show");
      $("#delete_body #form").attr("action", $(this).data("url"));
      $("#delete_body #form").attr("data-pjax", '');
      $(this).val("");
    });



    // Delete Form Action
    $(document).on("submit", "#delete_body #form", function () {
      $('#cja_delete').delay(100).fadeOut(100);
      setTimeout(function(){
        $('#cja_delete').modal("hide");
      }, 200);
    });


    
    <?php if(Session::has('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS')): ?>
      <?php echo __js::toast(Session::get('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS')); ?>

    <?php endif; ?>



  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>