<?php $__env->startSection('title'); ?>
  <?php echo e($mill_district->mill_district); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>

  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#show_md" data-toggle="tab">Mill District Info</a></li>

      <li>
        <a href="#show_seminars" data-toggle="tab">
          Seminars 
          <?php echo __html::label_int($mill_district->seminars->count()); ?>

        </a>
      </li>

      <li>
        <a href="#show_seminars_participants" data-toggle="tab">
          Seminar Participants 
          <?php echo __html::label_int(count($seminar_participants)); ?>

        </a>
      </li>

      <li>
        <a href="#show_bf" data-toggle="tab">
          Block Farm 
          <?php echo __html::label_int($mill_district->blockFarms->count()); ?>

        </a>
      </li>
      <li>
        <a href="#show_bfm" data-toggle="tab">
        Block Farm Members 
        <?php echo __html::label_int(count($bf_members)); ?>

        </a>
      </li>
      <li>
        <a href="#show_sch" data-toggle="tab">
          Scholars
          <?php echo __html::label_int($mill_district->scholars->count()); ?>

        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="show_md">
        <div class="well well-sm bg-white">
          <div class="row">
            <div class="col-md-5">
              <dl class="dl-horizontal">
                <dt>Mill District:</dt>
                <dd><?php echo e($mill_district->mill_district); ?></dd>

                <dt>Chairman:</dt>
                <dd><?php echo e($mill_district->chairman); ?></dd>

                <dt>Location:</dt>
                <dd><?php echo e($mill_district->location); ?></dd>

                <dt>Region:</dt>
                <dd><?php echo e($mill_district->region); ?></dd>
              </dl>
            </div>
            <div class="col-md-7">
                <dl class="dl-horizontal">
                  <dt>Address:</dt>
                  <dd><?php echo e($mill_district->address); ?></dd>

                  <dt>MD Officer:</dt>
                  <dd><?php echo e($mill_district->mdo); ?></dd>

                  <dt>Contact No.:</dt>
                  <dd><?php echo e($mill_district->phone); ?></dd>

                </dl>
            </div>
          </div>
        </div>
        <div class="well well-sm bg-white">
          <div class="row">
            <div class="col-md-3">
              <div class="panel panel-info">
                <div class="panel-heading" style="padding-top: 2px; padding-bottom: 0">
                  <center>
                    <label>Scholars</label>  
                  </center>
                </div>
                <div class="panel-body">
                  <canvas id="scholars_m_f" width="400" height="350"></canvas>
                  <center>
                    <p>Total # of Scholars: <b><?php echo e($mill_district->scholars->count()); ?> </b></p>
                  </center>
                </div>
              </div>
            </div>

            <div class="col-md-9">
              <div class="panel panel-info ">
                <div class="panel-heading" style="padding-top: 2px; padding-bottom: 0">
                  <center>
                    <label>Block Farm Members</label>  
                  </center>
                </div>
                <div class="panel-body">
                  <canvas id="per_block_farm" width="400" height="100"></canvas>
                  <center>
                    <p>Total # of Block Farms: <b><?php echo e($mill_district->blockFarms->count()); ?> </b>
                     |

                    Total # of Block Farm Members: <b><?php echo e($mill_district->its_block_farm_members->count()); ?> </b>
                    </p>

                  </center>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="panel panel-info">
                <div class="panel-heading" style="padding-top: 2px; padding-bottom: 0">
                  <center>
                    <label>Block Farm Members by Civil Status</label>  
                  </center>
                </div>
                <div class="panel-body">
                  <canvas id="civil_status_chart" width="400" height="200"></canvas>
                  <center>
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <!-- /.tab-pane -->

      <div class="tab-pane" id="show_seminars">
        <table class="table table-bordered table-hover bg-white" id="seminars_table">
          <thead>
            <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
              <th>Title</th>
              <th>Sponsor</th>
              <th>Venue</th>
              <th>Date Covered</th>
              <th>Participants</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($mill_district->seminars)): ?>
              <?php $__currentLoopData = $mill_district->seminars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seminar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($seminar->title); ?></td>
                  <td><?php echo e($seminar->sponsor); ?></td>
                  <td><?php echo e($seminar->venue); ?></td>
                  <td>
                    <?php
                      if($seminar->date_covered_from == $seminar->date_covered_to ){
                        echo date("M. d, Y",strtotime($seminar->date_covered_from));
                       }else{
                        echo date("M. d, Y",strtotime($seminar->date_covered_from)).' - '.date("M. d, Y",strtotime($seminar->date_covered_to));
                       }
                    ?>
                  </td>
                  <td class="text-center">
                    <?php echo e($seminar->seminarParticipant->count()); ?> 
                    (
                      <span class="text-red">
                        <i class="fa fa-female"></i> = <?php echo e($seminar->seminarParticipant_female->count()); ?> 
                      </span>
                      ,

                      <span class="text-green">
                      <i class="fa fa-male"></i> = <?php echo e($seminar->seminarParticipant_male->count()); ?> 
                      </span>
                    )
                  </td>
                  <td>
                    <a href="<?php echo e(route('dashboard.seminar.index')); ?>?search=<?php echo e($seminar->slug); ?>" target="_blank">
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fa fa-gear"></i>
                        View | Edit | Delete
                      </button>
                    </a>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      
      <div class="tab-pane" id="show_seminars_participants">
        <table class="table table-bordered table-hover bg-white" id="seminar_participants_table" style="width: 100% !important">
          <thead>
            <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
              <th>Seminar</th>
              <th>Name</th>
              <th>Address</th>
              <th>Contact no.</th>
              <th>Email</th>
              <th>Sex</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($seminar_participants)): ?>
              <?php $__currentLoopData = $seminar_participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td>
                    <?php echo e($participant->seminar->title); ?> - 
                    (<?php echo e($participant->seminar->seminarParticipant->count()); ?> total) 
                  </td>
                  <td><?php echo e($participant->fullname); ?></td>
                  <td><?php echo e($participant->address); ?></td>
                  <td class="text-center"><?php echo e(isset($participant->contact_no) ? $participant->contact_no : 'N/A'); ?></td>
                  <td class="text-center"><?php echo e(isset($participant->email) ? $participant->email : 'N/A'); ?></td>
                  <td style="width: 15px"><?php echo __html::sex($participant->sex); ?></td>
                  <td style="width: 30px">
                    <a href="<?php echo e(route('dashboard.seminar.index')); ?>?search=<?php echo e($participant->seminar->slug); ?>" target="_blank">
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fa fa-gear"></i>
                        View seminar
                      </button>
                    </a>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="tab-pane" id="show_bf">
        <table class="table table-bordered table-hover bg-white" id="block_farm_table">
          <thead>
            <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
              <th>Block Farm</th>
              <th>Source of Fund</th>
              <th>Enrolee</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($mill_district->blockFarms)): ?>
              <?php $__currentLoopData = $mill_district->blockFarms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block_farm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($block_farm->block_farm_name); ?></td>
                  <td><?php echo e($block_farm->fund_source); ?></td>
                  <td><?php echo e($block_farm->enrolee_name); ?></td>
                  <td style="width: 35px">
                    <a href="<?php echo e(route('dashboard.block_farm.index')); ?>?search=<?php echo e($block_farm->slug); ?>" target="_blank">
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fa fa-gear"></i>
                        View | Edit | Delete
                      </button>
                    </a>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>



      <div class="tab-pane" id="show_bf">
        <table class="table table-bordered table-hover bg-white" id="block_farm_table">
          <thead>
            <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
              <th>Block Farm</th>
              <th>Source of Fund</th>
              <th>Enrolee</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($mill_district->blockFarms)): ?>
              <?php $__currentLoopData = $mill_district->blockFarms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block_farm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($block_farm->block_farm_name); ?></td>
                  <td><?php echo e($block_farm->fund_source); ?></td>
                  <td><?php echo e($block_farm->enrolee_name); ?></td>
                  <td style="width: 35px">
                    <a href="<?php echo e(route('dashboard.block_farm.index')); ?>?search=<?php echo e($block_farm->slug); ?>" target="_blank">
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fa fa-gear"></i>
                        View | Edit | Delete
                      </button>
                    </a>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
        <!-- /.tab-pane -->
      <div class="tab-pane" id="show_bfm">
        <table class="table table-bordered table-hover bg-white" id="block_farm_members_table" style="width: 100% !important">
          <thead>
            <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
              <th>Block Farm</th>
              <th>Fullname</th>
              <th>Block Farm</th>
              <th>Bday</th>
              <th>Age</th>
              <th>Sex</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($bf_members)): ?>
              <?php $__currentLoopData = $bf_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bf_member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td>
                    <?php echo e($bf_member->blockFarm->block_farm_name); ?> 
                    - 
                    <?php echo e($bf_member->blockFarm->blockFarmMembers->count()); ?> member(s)
                  </td>
                  <td><?php echo e($bf_member->lastname); ?>, <?php echo e($bf_member->firstname); ?></td>
                  <td><?php echo e($bf_member->blockFarm->block_farm_name); ?></td>
                  <td><?php echo e(date("M. d, Y",strtotime($bf_member->bday))); ?></td>
                  <td style="width: 15px" class="text-center"><?php echo e(\Carbon::parse($bf_member->bday)->age); ?></td>
                  <td style="width: 15px"><?php echo __html::sex($bf_member->sex); ?></td>
                  <td style="width: 35px">
                    <a href="<?php echo e(route('dashboard.bf_member.index')); ?>?search=<?php echo e($bf_member->slug); ?>" target="_blank">
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fa fa-gear"></i>
                        View | Edit | Delete
                      </button>
                    </a>
                  </td>
                  
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="show_sch">
        <table class="table table-bordered table-hover bg-white" id="scholars_table">
          <thead>
            <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
              <th>Fullname | Address</th>
              <th>Scholarship</th>
              <th>Course | School</th>
              <th>Birthday | Age</th>
              <th>Sex</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($mill_district->scholars)): ?>
              <?php $__currentLoopData = $mill_district->scholars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scholar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td>
                    <div><?php echo e($scholar->lastname); ?>, <?php echo e($scholar->firstname); ?> <?php echo e(substr($scholar->middlename, 0,1)); ?>. 
                          <div class="table-subdetail">
                              <?php echo e($scholar->address_city); ?>, <?php echo e($scholar->address_province); ?>

                          </div>
                      </div>
                    </td>
                    <td>
                      <?php echo e($scholar->scholarship_applied); ?>

                    </td>
                    <td>
                      <div><?php echo e($scholar->course_applied); ?>

                          <div class="table-subdetail">
                              <?php echo e($scholar->school); ?>

                          </div>
                      </div>
                    </td>
                    <td>
                      <div><?php echo e(date("M. d, Y",strtotime($scholar->birth))); ?>

                          <div class="table-subdetail">
                              <?php echo e(\Carbon::parse($scholar->birth)->age); ?> year(s) old
                          </div>
                      </div>
                    </td>
                    <td style="width: 13px">
                      <?php echo __html::sex($scholar->sex); ?>

                    </td>
                    <td style="width: 35px">
                      <a href="<?php echo e(route('dashboard.scholars.index')); ?>?search=<?php echo e($scholar->slug); ?>" target="_blank">
                        <button type="button" class="btn btn-default btn-xs">
                          <i class="fa fa-gear"></i>
                          View | Edit | Delete
                        </button>
                      </a>
                    </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>

  <div class="row">
    <?php echo __html::timestamp($mill_district ,"5"); ?> 

    <div class="col-md-2">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script type="text/javascript">

    $('#scholars_table').DataTable({});
    $('#seminars_table').DataTable({});
    $('#block_farm_table').DataTable({});
    $('#seminar_participants_table').DataTable({
      'rowGroup': {
        'dataSrc': 0
      },
      'columnDefs':[
        {
          'targets': 0,
          'visible': false
        }
      ]
    });
    $('#block_farm_members_table').DataTable({
      'rowGroup': {
        'dataSrc': 0
      },
      'columnDefs':[
        {
          'targets': 0,
          'visible': false
        }
      ]
    });

    $(document).ready(function(){
      var ctx = $('#per_block_farm');
      var scholars = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php $__currentLoopData = $mill_district->blockFarms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block_farm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php if(strlen($block_farm->block_farm_name) > 20): ?>
                '<?php echo e(substr($block_farm->block_farm_name, 0, 14)); ?>...<?php echo e(substr(
                    $block_farm->block_farm_name, 
                    strlen($block_farm->block_farm_name)-5, 
                    strlen($block_farm->block_farm_name))); ?>',
              <?php else: ?>
                '<?php echo e($block_farm->block_farm_name); ?>',
              <?php endif; ?>
              
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          ],

          datasets: [
              {
                data: [
                  <?php $__currentLoopData = $mill_district->blockFarms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block_farm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '<?php echo e($block_farm->blockFarmMembers
                      ->where("sex","=","FEMALE")
                      ->count()); ?>',
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>,
                ],
                label: 'FEMALE',
                backgroundColor: 'rgb(255,105,180)',
              },
              {
                data: [
                  <?php $__currentLoopData = $mill_district->blockFarms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block_farm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '<?php echo e($block_farm->blockFarmMembers
                      ->where("sex","=","MALE")
                      ->count()); ?>',
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                label: 'MALE',
                backgroundColor: 'rgb(60,179,113)',
              }
            ]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      },
                      stacked: true,
                  }],
                  xAxes: [{ stacked: true }],
              }
          }
      });
      var scholars_pie = new Chart($("#scholars_m_f"), {
        type: 'pie',
        data: {
          datasets: [
            {
              data: [<?php echo e($mill_district->scholars_male->count()); ?>, <?php echo e($mill_district->scholars_female->count()); ?>],
              backgroundColor: [
                'rgb(60,179,113)',
                'rgb(255,105,180)',
              ]
            }
          ],
          labels: [
              'Male',
              'Female',
          ],
          borderColor: '#ddffee'
         }
    });


      var civil_status_chart = new Chart($("#civil_status_chart"), {
          type: 'bar',
          data: {
            "labels": [
              <?php if(count($bf_members_by_civil) > 0): ?>
                <?php $__currentLoopData = $bf_members_by_civil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $members): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  '<?php echo e($key); ?> (<?php echo e(count($members)/count($bf_members)*100); ?>%)  ',
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            ],

            datasets: [
              {
                data: [
                  <?php $__currentLoopData = $bf_members_by_civil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $members): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '<?php echo e(count($bf_members_by_civil[$key])); ?>',
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                label: '',
                backgroundColor: 'rgb(138, 65, 158)',
              },
            ]
          },
          options: {
              "scales": {
                  "yAxes": [{
                      "ticks": {
                          "beginAtZero": true,
                          userCallback: function(label, index, labels) {
                             // when the floored value is the same as the value we have a whole number
                             if (Math.floor(label) === label) {
                                 return label;
                             }

                         },
                      }
                  }]
              }
          }
      });


    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.modal-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>