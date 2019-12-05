<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span></button>
  <h4 class="modal-title">{{ $seminar->title }}</h4>
</div>
<div class="modal-body">
	<div class="well well-sm">
		<div class="row">
			<div class="col-md-4">
				<p>Title: <b> {{ $seminar->title }} </b> </p>
			</div>
			<div class="col-md-4">
				<p>Sponsor: <b> {{ $seminar->sponsor }} </b> </p>
			</div>
			<div class="col-md-4">
				<p>Venue: <b> {{ $seminar->venue }} </b> </p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<p>From: <b> {{ date('F d, Y', strtotime($seminar->date_covered_from)) }} </b> </p>
			</div>
			<div class="col-md-4">
				<p>To: <b> {{ date('F d, Y', strtotime($seminar->date_covered_to)) }} </b> </p>
			</div>
		</div>
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
	<button class="btn btn-default" data-dismiss="modal"> Done </button>
</div>