<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">{{$committee_member->lname}}, {{$committee_member->fname}} {{$committee_member->mname}}</h4>
</div>

<div class="modal-body">
	<div class="row">
		<div class="col-md-12" style="height: auto !important;">
			<div class="well well-sm">
				<dl class="dl-horizontal no-margin">
					<dt>Last Name:</dt>
					<dd>{{$committee_member->lname}}</dd>

					<dt>First Name:</dt>
					<dd>{{$committee_member->fname}}</dd>

					<dt>Middle Name:</dt>
					<dd>{{$committee_member->mname}}</dd>

					<dt>Sex:</dt>
					<dd>{{$committee_member->sex}}</dd>

					<dt>Base:</dt>
					<dd>{{$committee_member->based_on}}</dd>

					<dt>Status as member:</dt>
					<dd>
						@if($committee_member->is_active == 1)
							<span class="label bg-green">ACTIVE</span>
						@else
							<span class="label bg-red">INACTIVE</span>
						@endif
					</dd>
				</dl>
			</div>

			
		</div>
	</div>
	@if(!empty($committee_member->employeeOnAfd))
		<div class="row">
			<div class="col-md-12" style="height: auto !important;">
			<div class="well well-sm">
				<dl class="dl-horizontal no-margin">
					<p class="page-header-sm text-center on-well text-info">
						Member's Information from SWEP-AFD
					</p>

					<dt>Employee No.:</dt>
					<dd>{{$committee_member->employeeOnAfd->employee_no}}</dd>

					<dt>Position:</dt>
					<dd>{{$committee_member->employeeOnAfd->position}}</dd>

					<dt>Status as Employee:</dt>
					<dd>
						@if($committee_member->employeeOnAfd->is_active == "ACTIVE")
							<span class="label bg-green">ACTIVE</span>
						@else
							<span class="label bg-red">INACTIVE</span>
						@endif
					</dd>

					<dt>Date of Birth:</dt>
					<dd>{{date("F d, Y",strtotime($committee_member->employeeOnAfd->date_of_birth))}}</dd>

					<dt>Age:</dt>
					<dd>
						{{Carbon::parse($committee_member->employeeOnAfd->date_of_birth)->age}}
					</dd>
				</dl>
			</div>
		</div>
		</div>
	

	@endif



</div>

<div class="modal-footer">
	<div class="row">
		{!! __html::timestamp($committee_member ,"5") !!} 

		<div class="col-md-2">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
