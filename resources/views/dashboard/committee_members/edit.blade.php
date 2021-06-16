<form id= "edit_member_form" data="{{$committee_member->slug}}">
	@csrf
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">{{$committee_member->lname}}, {{$committee_member->fname}} - Edit</h4>
	</div>
	<div class="modal-body">
		<div class="row">

			{!! __form::textbox(
				'4 lname', 'lname', 'text', 'Last name*', 'Last name*', $committee_member->lname, '', '', ''
				) !!}

			{!! __form::textbox(
				'4 fname', 'fname', 'text', 'First Name*', 'First Name*', $committee_member->fname, '', '', ''
				) !!}

			{!! __form::textbox(
				'4 mname', 'mname', 'text', 'Middle Name', 'Middle Name', $committee_member->mname, '', '', ''
				) !!}
		</div>
		<div class="row">
			{!! __form::select_static(
			'4 sex', 'sex', 'Sex: *', $committee_member->sex , [
				'Male' => 'MALE', 
				'Female' => 'FEMALE', 
			], '', '', '', ''
			) !!}

			{!! __form::select_static(
				'3 based_on', 'based_on', 'Base*', $committee_member->based_on, [
					'Visayas' => 'Visayas',
					'Quezon' => 'Quezon',           
				], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
				) !!}

			{!! __form::select_static(
			'3 is_active', 'is_active', 'Status as member*', $committee_member->is_active, [
				'Active' => '1',
				'Inactive' => '0',           
			], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
			) !!}
		</div>
	</div>
	<div class="modal-footer">
		<button tabindex="-1" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}"><i class="fa fa-save"></i> Save</button>
	</div>
</form>