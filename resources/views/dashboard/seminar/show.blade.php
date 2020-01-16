<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span></button>
  <h4 class="modal-title">{{ $seminar->title }}</h4>
</div>
<div class="modal-body">
	<div class="well well-sm">

		<dl class="dl-horizontal">
	        <dt>Title:</dt>
	        <dd>{{ $seminar->title }}</dd>

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
<div class="modal-footer">
	<div class="row">
		{!! __html::timestamps(
			$seminar->creator['firstname'] ." ".$seminar->creator['lastname'],
			$seminar->created_at,
			$seminar->updater['firstname'] ." ". $seminar->updater['lastname'],
			$seminar->updated_at,"5"
		) !!}		

		<div class="col-md-2">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>