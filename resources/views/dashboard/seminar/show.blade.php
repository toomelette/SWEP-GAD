<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span></button>
  <h4 class="modal-title">{{ $seminar->title }}</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-6">
			<div class="well well-sm">

				<dl class="dl-horizontal">
			        <dt>Title:</dt>
			        <dd>{{ $seminar->title }}</dd>

			        <dt>Mill District:</dt>
			        <dd>{{ $seminar->millDistrict->mill_district or 'N/A'}}</dd>

			        <dt>Sponsor:</dt>
			        <dd>{{ $seminar->sponsor }}</dd>
			       
			       	<dt>Venue:</dt>
			        <dd>{{ $seminar->venue }}</dd>

			        <dt>Date from:</dt>
			        <dd> {{ date('F d, Y', strtotime($seminar->date_covered_from)) }} </dd>

			        <dt>Date to:</dt>
			        <dd>{{ date('F d, Y', strtotime($seminar->date_covered_to)) }}</dd>
			     </dl>
			</div>

			@if ($seminar->seminarSpeaker->count() > 0)
				<div class="well well-sm">
					<p class="text-center"> <b>Speakers</b> </p>
					<hr class="no-margin">
					<table class="table  table-bordered" style="background-color: white">
						<thead>
							<th>Speaker</th>
							<th>Topic</th>
						</thead>
						<tbody>
							@foreach ($seminar->seminarSpeaker as $data)
								<tr>
									<td> {{ $data->fullname }} </td>
									<td> {{ $data->topic }} </td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
				</div>

			@else
				<div class="well well-sm">
					<p class="text-center"> <b>No speaker for this seminar</b> </p>
				</div>

			@endif


				<hr>

		@if(!empty($seminar->attendance_sheet_filename) && $file_details['exists'] == 'true' )
			<div class="text-center">
				<label> Attendance Sheet Scanned File</label>
			</div>
			
			<div class="clearfix attatchment-horizontal">
				<div>
					<span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
				</div>
				<div>
					<div class="mailbox-attachment-info">
				        <a href="{{route('dashboard.seminar.download_attendance_sheet', $seminar->slug)}}?new={{md5(uniqid(rand(), true))}}" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{ $seminar->attendance_sheet_filename }} </a>
			            <span class="mailbox-attachment-size" >
			              {{ $file_details['size'] }}
			              <a href="{{route('dashboard.seminar.download_attendance_sheet', $seminar->slug)}}?new={{md5(uniqid(rand(), true))}}" target="_blank" class="download_attendance btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download fa-fw"></i> Download</a>
			              <a style="margin-right: 5px" href="{{route('dashboard.seminar.view_attendance_sheet', $seminar->slug)}}" target="_blank" class="download_attendance btn btn-default btn-xs pull-right"><i class="fa fa-file-text fa-fw"></i> View</a>
			            </span>
				      </div>
				</div>		
			</div>
		@else
			@if($file_details['exists'] == 'false')
				<div class="text-center text-warning">
					<label>
						<i class="fa fa-info-circle"></i> File not found.
					</label>
				</div>
			@else
				<div class="text-center text-blue">
					<label>
						<i class="fa  fa-info-circle"></i> 
						No attendance sheet attached.
					</label>
				</div>
			@endif

		@endif




		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<p class="text-center text-strong">Charts</p>
				</div>
				<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="well well-sm">
									<p class="text-strong text-center">Participants by Sex</p>
									<canvas id="sex_pie" width="400" height="250"></canvas>
									<p class="text-center">Total: {{count($seminar->seminarParticipant)}}</p>
								</div>
							</div>

							<div class="col-md-6">
								<div class="well well-sm">
									<p class="text-strong text-center">Participants by Status</p>
									<canvas id="status_pie" width="400" height="250"></canvas>
									<p class="text-center">Total: {{count($seminar->seminarParticipant)}}</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="well well-sm">
									<p class="text-strong text-center">Participants by Age</p>
									<canvas id="age_pie" width="400" height="250"></canvas>
									<p class="text-center">Total: {{count($seminar->seminarParticipant)}}</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="well well-sm">
									<p class="text-strong text-center">Participants by Education</p>
									<canvas id="educ_pie" width="400" height="250"></canvas>
									<p class="text-center">Total: {{count($seminar->seminarParticipant)}}</p>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	

	


	

</div>
<div class="modal-footer">
	<div class="row">
		{!! __html::timestamp($seminar ,"5") !!}

		<div class="col-md-2">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>



<script type="text/javascript">
	var sex_pie_chart = new Chart($("#sex_pie"), {
        type: 'pie',
        data: {
          datasets: [
            {
              data: [
              {{count($seminar->seminarParticipant->where("sex","=","MALE"))}},
              {{count($seminar->seminarParticipant->where("sex","=","FEMALE"))}}
              ],
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

    var status_pie_chart = new Chart($("#status_pie"), {
        type: 'pie',
        data: {
          datasets: [
            {
              data: [
              {{count($seminar->seminarParticipant->where("civil_status","=","Single"))}},
              {{count($seminar->seminarParticipant->where("civil_status","=","Married"))}},
              {{count($seminar->seminarParticipant->where("civil_status","=","Separated"))}},
              {{count($seminar->seminarParticipant->where("civil_status","=","Widowed"))}},
              {{count($seminar->seminarParticipant->where("civil_status","=",""))}},
              ],
              backgroundColor: [
              	'rgb(96,92,168)',
                'rgb(243,156,18)',
                'rgb(255,105,180)',
                'rgb(0,192,239)',
                'rgb(221,75,57)'
              ]
            }
          ],
          labels: [
              'Single',
              'Married',
              'Separated',
              'Widowed',
              'Prefer not to say',
          ],
          borderColor: '#ddffee'
         }
    });

    var age_pie_chart = new Chart($("#age_pie"), {
        type: 'pie',
        data: {
          datasets: [
            {
              data: [
              {{count($seminar->seminarParticipant->where("age","<=",18))}},
              {{count($seminar->seminarParticipant->where("age",">",18)->where('age',"<",60))}},
              {{count($seminar->seminarParticipant->where("age",">=",60))}}
              ],
              backgroundColor: [
              	'rgb(124, 150, 6)',
                'rgb(6, 150, 150)',
                'rgb(150, 66, 6)'
              ]
            }
          ],
          labels: [
              '18 and below',
              '19-59 y/o',
              '60 and above',
          ],
          borderColor: '#ddffee'
         }
    });

    var educ_pie_chart = new Chart($("#educ_pie"), {
        type: 'pie',
        data: {
          datasets: [
            {
              data: [
              {{count($seminar->seminarParticipant->where("educ_att","=",'Elementary'))}},
              {{count($seminar->seminarParticipant->where("educ_att","=",'High School'))}},
              {{count($seminar->seminarParticipant->where("educ_att","=",'College'))}},
              {{count($seminar->seminarParticipant->where("educ_att","=",""))}},
              ],
              backgroundColor: [
              	'rgb(252, 255, 161)',
                'rgb(161, 255, 203)',
                'rgb(161, 180, 255)',
                'rgb(221,75,57)'
              ]
            }
          ],
          labels: [
              'Elementary',
              'High School',
              'College',
              'Prefer not to say'
          ],
          borderColor: '#ddffee'
         }
    });




</script>