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
	
	<!-- {{ print_r($seminar->seminarSpeaker) }} -->
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


</div>
<div class="modal-footer">
	<div class="row">
		<div class="col-md-5">
			<div class="stamps">
				<small class="no-margin">
					Encoded by: 
					<b>
						{{ $seminar->creator['firstname'] }} {{ $seminar->creator['lastname'] }}
					</b> 
				</small>
				<br>
				<small class="no-margin">
					Timestamp: 
					<b>
						{{ date("F d, Y | h:i A",strtotime($seminar->created_at)) }}
					</b> 
				</small>
			</div>
		</div>
		<div class="col-md-5">

			<div class="stamps">
				<small class="no-margin">
					Last updated by: 
					<b>
						{{ $seminar->updater['firstname'] }} {{ $seminar->updater['lastname'] }}
					</b> 
				</small>
				<br>
				<small class="no-margin">
					Timestamp: 
					<b>
						{{ date("F d, Y | h:i A",strtotime($seminar->updated_at)) }}
					</b> 
				</small>
			</div>
		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>