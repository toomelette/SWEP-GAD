<?php
  
  $sugar_samples_static = __static::sugar_samples();
  $sugar_services_static = __static::sugar_services();

?>



<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>Fill Up Results</h1>
    <div class="pull-right" style="margin-top: -25px;">
      <?php echo __html::back_button(['dashboard.sugar_analysis.index', 'dashboard.sugar_analysis.show']); ?>

    </div>
</section>

<section class="content">


  <div class="col-md-12">

    <div class="box">
      
      <div class="box-header with-border">
        <h3 class="box-title">Results</h3>
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



        <form method="POST" action="<?php echo e(route('dashboard.sugar_analysis.update', $sugar_analysis->slug)); ?>" autocomplete="off">

            <?php echo csrf_field(); ?>

            <input name="_method" value="PUT" type="hidden">
            
            <div class="col-md-5">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><b>Form</b></h3>
                </div>
                
                <div class="box-body">

                  <div class="col-md-12"></div>

                  <?php echo __form::datepicker(
                    '12', 'week_ending',  'Week Ending *', old('week_ending') ? old('week_ending') : $sugar_analysis->week_ending, $errors->has('week_ending'), $errors->first('week_ending')
                  ); ?>


                  <div class="col-md-12"></div>

                  <?php echo __form::datepicker(
                    '12', 'date_submitted',  'Date Submitted *', old('date_submitted') ? old('date_submitted') : $sugar_analysis->date_submitted, $errors->has('date_submitted'), $errors->first('date_submitted')
                  ); ?>


                  <div class="col-md-12"></div>

                  <?php echo __form::datepicker(
                    '12', 'date_sampled',  'Date Sampled *', old('date_sampled') ? old('date_sampled') : $sugar_analysis->date_sampled, $errors->has('date_sampled'), $errors->first('date_sampled')
                  ); ?>


                  <div class="col-md-12"></div>

                  <?php echo __form::textbox(
                    '12', 'date_analyzed', 'text', 'Date Analyzed *', 'Date Analyzed', old('date_analyzed') ? old('date_analyzed') : $sugar_analysis->date_analyzed, $errors->has('date_analyzed'), $errors->first('date_analyzed'), ''
                  ); ?>


                  <div class="col-md-12"></div>

                  <?php echo __form::textbox(
                    '12', 'quantity_mt', 'text', 'Quantity <code>(Metric Tons)</code>', 'Quantity', old('quantity_mt') ? old('quantity_mt') : $sugar_analysis->quantity_mt, $errors->has('quantity_mt'), $errors->first('quantity_mt'), ''
                  ); ?>


                  <div class="col-md-12"></div>

                  <?php if($sugar_analysis->sugar_sample_id == $sugar_samples_static['muscovado']): ?>

                    <?php echo __form::textbox(
                      '12', 'code', 'text', 'Code', 'Code', old('code') ? old('code') : $sugar_analysis->code, $errors->has('code'), $errors->first('code'), ''
                    ); ?>


                    <div class="col-md-12"></div>

                  <?php endif; ?>

                  <?php if($sugar_analysis->sugar_sample_id == $sugar_samples_static['molasses']): ?>

                    <div class="col-md-12"></div>

                    <?php echo __form::textbox(
                      '12', 'source', 'text', 'Source', 'Source', old('source') ? old('source') : $sugar_analysis->source, $errors->has('source'), $errors->first('source'), ''
                    ); ?>


                    <div class="col-md-12"></div>

                  <?php endif; ?>

                  <?php echo __form::textbox(
                    '12', 'description', 'text', 'Description', 'Description', old('description') ? old('description') : $sugar_analysis->description, $errors->has('description'), $errors->first('description'), ''
                  ); ?>


                </div> 

              </div>
            </div>

            
            <div class="col-md-7">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><b>Parameters</b></h3>
                </div>
                
                <div class="box-body">

                  <?php $__currentLoopData = $sugar_analysis->sugarAnalysisParameter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if($data->sugar_service_id == $sugar_services_static['mois']): ?>
                    
                      <?php echo __form::textbox(
                        '4', $data->sugar_service_id .'_moisture', 'text', "MOISTURE", '0.00', old($data->sugar_service_id .'_moisture') ? old($data->sugar_service_id .'_moisture') : $data->moisture_result_dec, $errors->has($data->sugar_service_id .'_moisture'), $errors->first($data->sugar_service_id .'_moisture'), 'data-transform="uppercase"'
                      ); ?>

                    
                      <?php echo __form::textbox(
                        '4', $data->sugar_service_id .'_sf', 'text', "SAFETY FACTOR", '0.00', old($data->sugar_service_id .'_sf') ? old($data->sugar_service_id .'_sf') : $data->moisture_sf_dec, $errors->has($data->sugar_service_id .'_sf'), $errors->first($data->sugar_service_id .'_sf'), 'data-transform="uppercase"'
                      ); ?>

                      
                    <?php else: ?>

                      <?php echo __form::textbox(
                        '8', $data->sugar_service_id, 'text', strtoupper($data->name), '0.00', old($data->sugar_service_id) ? old($data->sugar_service_id) : $data->result_dec, $errors->has($data->sugar_service_id), $errors->first($data->sugar_service_id), 'data-transform="uppercase"'
                      ); ?>


                    <?php endif; ?>

                    <div class="col-md-4" style="margin-top:30px;">
                        <code><?php echo e($data->standard_str); ?></code>
                    </div>

                    <div class="col-md-12"></div>
                              
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

  <?php if(Session::has('SUGAR_ANALYSIS_UPDATE_SUCCESS')): ?>

    <?php echo __html::modal_print(
      'sa_update', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SUGAR_ANALYSIS_UPDATE_SUCCESS'), route('dashboard.sugar_analysis.show', Session::get('SUGAR_ANALYSIS_UPDATE_SUCCESS_SLUG'))
    ); ?>

  
  <?php endif; ?>

<?php $__env->stopSection(); ?> 







<?php $__env->startSection('scripts'); ?>

  <script type="text/javascript">


    <?php if(Session::has('SUGAR_ANALYSIS_UPDATE_SUCCESS')): ?>
      $('#sa_update').modal('show');
    <?php endif; ?>


    
    <?php if(Session::has('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS')): ?>
      <?php echo __js::toast(Session::get('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS')); ?>

    <?php endif; ?>

    
    $(document).ready(function(){
      $("#SS1017_moisture").keyup(function(){
        var denominator = 100 - $("#SS1001").val();
        var numerator = $("#SS1017_moisture").val();
        var sf = numerator / denominator;
        $("#SS1017_sf").val(sf.toFixed(2));
      });
    });


    $(document).ready(function(){
      $("#SS1017_moisture").keydown(function(){
        var denominator = 100 - $("#SS1001").val();
        var numerator = $("#SS1017_moisture").val();
        var sf = numerator / denominator;
        $("#SS1017_sf").val(sf.toFixed(2));
      });
    });

    
    $(document).ready(function(){
      $("#SS1001").keyup(function(){
        var denominator = 100 - $("#SS1001").val();
        var numerator = $("#SS1017_moisture").val();
        var sf = numerator / denominator;
        $("#SS1017_sf").val(sf.toFixed(2));
      });
    });


    $(document).ready(function(){
      $("#SS1001").keydown(function(){
        var denominator = 100 - $("#SS1001").val();
        var numerator = $("#SS1017_moisture").val();
        var sf = numerator / denominator;
        $("#SS1017_sf").val(sf.toFixed(2));
      });
    });


  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>