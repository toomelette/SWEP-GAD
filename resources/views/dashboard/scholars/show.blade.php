<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">{{ $scholars->lastname }}, {{ $scholars->firstname }} {{ $scholars->middlename }}</h4>
</div>

<div class="modal-body">
	<div class="well well-sm">
		<div class="row">
			<div class="col-md-4">
				<dl class="no-margin">
					<dt>Scholarship applied for:</dt>
					<dd>
						@switch($scholars->scholarship_applied)
							@case('CHED-U')
								CHED - Undergraduate Degree
								@break
							@case('CHED-G')	
								CHED - Graduate Degree
								@break
							@default
								{{$scholars->scholarship_applied }}
								@break
						@endswitch
					</dd>
				</dl>
			</div>
			<div class="col-md-4">
				<dl class="no-margin">
					<dt>Title of course applied for:</dt>
					<dd>{{ $scholars->course_applied }}</dd>
				</dl>
			</div>

			<div class="col-md-4">
				<dl class="no-margin">
					<dt>Name of State University/College:</dt>
					<dd>{{ $scholars->school }}</dd>
				</dl>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" style="height: auto !important;">
			<div class="well well-sm" >
				<dl class="dl-horizontal no-margin">
					<p class="page-header-sm text-center on-well text-info">
						Scholar Information
					</p>

					<dt>Last Name:</dt>
					<dd>{{ $scholars->lastname }}</dd>

					<dt>First Name:</dt>
					<dd>{{ $scholars->firstname }}</dd>

					<dt>Middle Name:</dt>
					<dd>{{ $scholars->middlename }}</dd>

					<dt>Date of Birth:</dt>
					<dd>{{ date("F d, Y",strtotime($scholars->birth)) }}</dd>

					<dt>Age:</dt>
					<dd>{{ $scholars->age  }}</dd>

					<dt>Sex:</dt>
					<dd>{{ $scholars->sex }}</dd>

					<dt>Status:</dt>
					<dd>{{ $scholars->civil_status }}</dd>

					<p class="page-header-sm text-center on-well text-info">
						Address
					</p>

					<dt>Mill District:</dt>
					<dd> {{ $scholars->millDistrict->mill_district or $scholars->mill_district }}</dd>

					<dt>Province:</dt>
					<dd> {{ $scholars->address_province }}</dd>

					<dt>City/Municipality:</dt>
					<dd> {{ $scholars->address_city }}</dd>

					<dt>Detailed address:</dt>
					<dd> {{ $scholars->address_specific }}</dd>

					<dt>Years living in address:</dt>
					<dd> {{ $scholars->address_no_years }}</dd>


				</dl>
			</div>
		</div>
		<div class="col-md-6">
			<div class="well well-sm">
				<dl class="dl-horizontal no-margin">
					

					<p class="page-header-sm text-center on-well text-info">
						Occupation
					</p>

					<dt>Occupation:</dt>
					<dd>
						{!! __html::check_null($scholars->occupation) !!}
					</dd>

					<dt>Name of Company:</dt>
					<dd>
						{!! __html::check_null($scholars->office_name) !!}
					</dd>

					<dt>Office address:</dt>
					<dd>
						{!! __html::check_null($scholars->office_address) !!}
					</dd>

					<dt>Office phone no.:</dt>
					<dd>
						{!! __html::check_null($scholars->office_phone) !!}
					</dd>

				</dl>
			</div>
		</div>
	</div>
	<p class="page-header-sm text-center text-info">
		Information of immediate relative
	</p>

	<div class="row">
		<div class="col-md-4">
			<div class="well well-sm">
				<dl class="no-margin">
					<dt>Mother's Name:</dt>
					<dd>
						{!! __html::check_null($scholars->mother_name) !!}
					</dd>

					<dt>Phone no.:</dt>
					<dd>
						{!! __html::check_null($scholars->mother_phone) !!}
					</dd>
				</dl>
			</div>
		</div>

		<div class="col-md-4">
			<div class="well well-sm">
				<dl class="no-margin">
					<dt>Father's Name:</dt>
					<dd>
						{!! __html::check_null($scholars->father_name) !!}
					</dd>

					<dt>Phone no.:</dt>
					<dd>
						{!! __html::check_null($scholars->father_phone) !!}
					</dd>
				</dl>
			</div>
		</div>

		<div class="col-md-4">
			<div class="well well-sm">
				<dl class="no-margin">
					<dt>Spouse's Name:</dt>
					<dd>
						{!! __html::check_null($scholars->spouse_name) !!}
					</dd>

					<dt>Phone no.:</dt>
					<dd>
						{!! __html::check_null($scholars->spouse_phone) !!}
					</dd>
				</dl>
			</div>
		</div>

	</div>
</div>

<div class="modal-footer">
	<div class="row">

		{!! __html::timestamps(
			$scholars->creator['firstname'] ." ".$scholars->creator['lastname'],
			$scholars->created_at,
			$scholars->updater['firstname'] ." ". $scholars->updater['lastname'],
			$scholars->updated_at,"4"
		) !!}		

		<div class="col-md-4">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
