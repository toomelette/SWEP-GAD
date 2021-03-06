<?php

  $sugar_samples_static = __static::sugar_samples();
  $sugar_services_static = __static::sugar_services();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Quality Test Certificate</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo e(asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('template/bower_components/font-awesome/css/font-awesome.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('template/dist/css/AdminLTE.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('css/print.css')); ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">


  <style type="text/css">

    table, td {

      border: 1px solid black;

    }

    thead{

      -webkit-print-color-adjust: exact; 
      background-color: #78B681 !important;

    }

    .data-row-head{

      text-align: center;
      padding:5px;
      font-size:14px;
      font-weight: bold;
      
    }

    .data-row-body-parameter{

      padding:5px;
      font-size:14px;
      line-height: 17px;
      
    }

    .data-row-body{

      text-align: center;
      padding:5px;
      font-size:14px;
      
    }

    .bg-wm{

      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      position:absolute;
      opacity:0.3;
      margin-top: 150px;
      padding:80px;

    }


  </style>

</head>

<body onload="window.print();" onafterprint="window.close()">

  <img class="bg-wm" src="<?php echo e(asset('images/sra_wm.jpg')); ?>">

  <div class="wrapper">

    
    <div class="row" style="padding:10px;">
      <div class="col-md-1"></div>
      <div class="col-md-12">
        <div class="col-sm-3">
          <img src="<?php echo e(asset('images/sra.png')); ?>" style="width:110px;">
        </div>
        <div class="col-sm-8" style="padding-right:125px; font-family: tahoma; line-height:13px; margin-left:-40px;">
          <span style="font-size:12px;">Republic of the Philippines</span><br>
          <span style="font-size:12px;">Department of Agriculture</span><br>
          <span style="font-size:12px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
          <span style="font-size:12px;">North Avenue, Diliman, Quezon City</span><br>
          <span style="font-size:12px;">Philippines 6100</span><br>
          <span style="font-size:12px;">TIN 000-784-336</span>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <div class="col-md-1"></div>
    </div>




    
    <div class="row" style="margin-top:5px;">

      <div class="col-md-12" style="text-align:center; margin-top:5px;">
        <?php if($sugar_analysis->sugar_sample_id == $sugar_samples_static['muscovado']): ?>
          <span style="font-size:15px; font-weight: bold;">MUSCOVADO SUGAR QUALITY TEST CERTIFICATE</span>
        <?php elseif($sugar_analysis->sugar_sample_id == $sugar_samples_static['molasses']): ?>
          <span style="font-size:15px; font-weight: bold;">QUALITY TEST ON MOLASSES</span>
        <?php elseif($sugar_analysis->sugar_sample_id == $sugar_samples_static['rawSugar']): ?>
          <span style="font-size:15px; font-weight: bold;">RAW SUGAR QUALITY TEST CERTIFICATE</span>
        <?php endif; ?>
      </div>



      <div class="col-sm-12" style="margin-top:10px;">  
        <div class="col-sm-4">
          <span>DATE</span>
        </div>
        <div class="col-sm-8">
          <p>: <?php echo e(__dataType::date_parse($sugar_analysis->date, 'F d, Y')); ?></p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>SAMPLE NO.</span>
        </div>
        <div class="col-sm-8">
          <p>: <?php echo e($sugar_analysis->sample_no); ?></p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>ORIGIN</span>
        </div>
        <div class="col-sm-8">
          <p>: <?php echo e($sugar_analysis->origin); ?></p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>ADDRESS</span>
        </div>
        <div class="col-sm-8">
          <p>: <?php echo e($sugar_analysis->address); ?></p>
        </div>
      </div>




      <?php if($sugar_analysis->sugar_sample_id == $sugar_samples_static['muscovado']): ?>

        <div class="col-sm-12" style="margin-top:5px;">  
          <div class="col-sm-4">
            <span>CODE</span>
          </div>
          <div class="col-sm-8">
            <p>: <?php echo e($sugar_analysis->code); ?></p>
          </div>
        </div>

      <?php else: ?>

        <div class="col-sm-12" style="margin-top:5px;">  
          <div class="col-sm-4">
            <span>QUANTITY</span>
          </div>
          <div class="col-sm-8">
            <p>: <?php echo e(number_format($sugar_analysis->quantity_mt, 3)); ?> MT</p>
          </div>
        </div>
        
      <?php endif; ?>

      <?php if($sugar_analysis->sugar_sample_id == $sugar_samples_static['molasses']): ?>

        <div class="col-sm-12" style="margin-top:-10px;">  
          <div class="col-sm-4">
            <span>SOURCE</span>
          </div>
          <div class="col-sm-8">
            <p>: <?php echo e($sugar_analysis->source); ?></p>
          </div>
        </div>

      <?php endif; ?>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>WEEK ENDING</span>
        </div>
        <div class="col-sm-8">
          <p>: <?php echo e(__dataType::date_parse($sugar_analysis->week_ending, 'F d, Y')); ?></p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>DATE SAMPLED</span>
        </div>
        <div class="col-sm-8">
          <p>: <?php echo e(__dataType::date_parse($sugar_analysis->date_sampled, 'F d, Y')); ?></p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>DATE SUBMITTED</span>
        </div>
        <div class="col-sm-8">
          <p>: <?php echo e(__dataType::date_parse($sugar_analysis->date_submitted, 'F d, Y')); ?></p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>DATE ANALYZED</span>
        </div>
        <div class="col-sm-8">
          <p>: <?php echo e($sugar_analysis->date_analyzed); ?></p>
        </div>
      </div>



      <div class="col-sm-12" style="margin-top:5px;">  
        <div class="col-sm-4">
          <span>DESCRIPTION OF SAMPLE</span>
        </div>
        <div class="col-sm-8">
          <p>: <?php echo e($sugar_analysis->description); ?></p>
        </div>
      </div>

    </div>



    

    <?php if($sugar_analysis->sugar_sample_id == "SS1001"): ?>

      
      <table style="margin-left:10px; margin-right:10px; border:solid 1px;">
  
        <thead>
          <td class="data-row-head" style="width:350px;">PARAMETERS</td>
          <td class="data-row-head" style="width:150px;">RESULTS</td>
          <td class="data-row-head" style="width:150px;">SPECIFICATION AS PRODUCED</td>
          <td class="data-row-head" style="width:150px;">ASSESSMENT</td>
        </thead>
              
        <?php $__currentLoopData = $sugar_analysis->sugarAnalysisParameter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <tbody>

            <td class="data-row-body-parameter">
              <?php echo e($data->name); ?><br>
              <?php $__currentLoopData = $data->sugarAnalysisParameterMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_sugar_apm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($data_sugar_apm->name); ?><br>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>

            <td class="data-row-body">
              <?php if($data->sugar_service_id == $sugar_services_static['mois']): ?>
                <?php echo e(number_format($data->moisture_result_dec, 2) .' / '. number_format($data->moisture_sf_dec, 2)); ?>

              <?php else: ?>
                <?php echo e(number_format($data->result_dec, 2)); ?>

              <?php endif; ?>
            </td>

            <td class="data-row-body"><?php echo e($data->standard_str); ?></td>
            <td class="data-row-body"><?php echo e($data->assessment); ?></td>

          </tbody>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </table>

    <?php elseif($sugar_analysis->sugar_sample_id == "SS1004" || $sugar_analysis->sugar_sample_id == "SS1003"): ?>

      
      <table style="margin-left:auto; margin-right:auto; border:solid 1px;">
  
        <thead>
          <td class="data-row-head" style="width:350px;">PARAMETERS</td>
          <td class="data-row-head" style="width:150px;">RESULTS</td>
        </thead>
              
        <?php $__currentLoopData = $sugar_analysis->sugarAnalysisParameter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <tbody>

            <td class="data-row-body-parameter">
              <?php echo e($data->name); ?><br>
              <?php if($data->sugar_service_id == $sugar_services_static['totalReducingSugarafterHydrolysis']): ?>
                <?php $__currentLoopData = $data->sugarAnalysisParameterMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_sugar_apm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php echo e($data_sugar_apm->name); ?><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </td>

            <td class="data-row-body">
              <?php if($data->sugar_service_id == $sugar_services_static['mois']): ?>
                <?php echo e(number_format($data->moisture_result_dec, 2) .' / '. number_format($data->moisture_sf_dec, 2)); ?>

              <?php else: ?>
                <?php echo e(number_format($data->result_dec, 2)); ?>

              <?php endif; ?>
            </td>

          </tbody>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </table>

      <?php endif; ?>

    







    
    <div class="row">

      <div class="col-sm-12" style="margin-left:-5px; margin-top:10px;">

        <div class="col-sm-2">
          <span>Charges</span>
        </div>

        <div class="col-sm-10">
          <span>: Php <b><?php echo e(number_format($sugar_analysis->total_price, 2)); ?></b></span>
        </div>

        <div class="col-sm-2">
          <span>OR #</span>
        </div>

        <div class="col-sm-10">
          <span> : <b><?php echo e($sugar_analysis->or_no); ?></b></span>
        </div>

        <div class="col-sm-6" style="margin-top:20px;">
          <span>Certified Correct:</span>
        </div>

        <div class="col-sm-6" style="margin-top:20px;">
          <span>Noted by:</span>
        </div>

        <div class="col-sm-6" style="margin-top:40px;">
          <span><b>JANET C. DILAG, RCh</b></span><br>
          <span>SRS II - LABORATORY SERVICES, VISAYAS</span><br>
          <span>CHEMIST LICENSE NO. 6302</span>
        </div>

        <div class="col-sm-6" style="margin-top:40px;">
          <span><b>MARY ANTOINETTE S. TAMPO</b></span><br>
          <span>DEPARTMENT MANAGER III</span><br>
          <span>REGULATION DEPARTMENT</span>
        </div>

      </div>
    
    </div>




  </div>

</body>

</html>

