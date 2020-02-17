<form id="edit_scholars_form" data="{{ $scholars->slug }}" autocomplete="off" >
	@csrf
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">{{ $scholars->lastname }}, {{ $scholars->firstname }} - Edit</h4>
	</div>
	<div class="modal-body">      
		<div class="row">
	        {!! __form::select_static(
	            '3 scholarship_applied', 'scholarship_applied', 'Scholarship applied for: *', $scholars->scholarship_applied, [
	              'TESDA' => 'TESDA', 
	              'CHED' => 'CHED', 
	              'SRA' => 'SRA', 
	            ], '', '', '', ''
	        ) !!}

	        {!! __form::textbox(
	          '5 course_applied', 'course_applied', 'text', 'Title of course applied for: *', 'Title of course applied for', $scholars->course_applied, '', '', ''
	        ) !!}

	        {!! __form::textbox(
	          '4 school', 'school', 'text', 'Name of State University/College: *', 'Name of State University/College', $scholars->school, '', '', ''
	        ) !!}

	    </div>


		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_11" data-toggle="tab" aria-expanded="true">Personal Information</a></li>
				<li class=""><a href="#tab_22" data-toggle="tab" aria-expanded="false">Occupation and Relatives</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_11">
					<p class="page-header-sm text-info">
				        Information about the scholar
				      </p>

				      <div class="row">
				        {!! __form::textbox(
				          '4 firstname', 'firstname', 'text', 'First Name *', 'First Name', $scholars->firstname, '', '', ''
				        ) !!}

				        {!! __form::textbox(
				          '4 middlename', 'middlename', 'text', 'Middle Name *', 'Middle Name', $scholars->middlename, '', '', ''
				        ) !!}

				        {!! __form::textbox(
				          '4 lastname', 'lastname', 'text', 'Last Name *', 'Last Name', $scholars->lastname, '', '', ''
				        ) !!}
				      </div>

				      <div class="row">
				      	 {!! __form::select_static(
			                  '4 mill_district', 'mill_district', 'Mill District: *', $scholars->mill_district , $mill_districts_list , '', '', '', ''
			                ) !!}


				        {{-- {!! __form::textbox(
				          '4 mill_district', 'mill_district', 'text', 'Mill District *', 'Mill District', $scholars->mill_district, '', '', ''
				        ) !!} --}}


				        {!! __form::datepicker(
				          '3 birth', 'birth',  'Birthday *', date("m/d/Y", strtotime($scholars->birth) ), '', ''
				        ) !!}


				        {!! __form::select_static(
				          '2 sex', 'sex', 'Sex: *', $scholars->sex , [
				            'Male' => 'MALE', 
				            'Female' => 'FEMALE', 
				          ], '', '', '', ''
				        ) !!}

				        {!! __form::select_static(
				          '3 civil_status', 'civil_status', 'Civil Status*', $scholars->civil_status, [
				            'Single' => 'Single',
				            'Married' => 'Married',
				            'Divorced' => 'Divorced',
				            'Separated' => 'Separated',
				            'Widowed' => 'Widowed'               
				          ], '', '', '', ''
				        ) !!}
				      </div>

				      <p class="page-header-sm text-info">
				        Address of the scholar
				      </p>

				      <div class="row">
				        {!! __form::textbox(
				          '3 address_province', 'address_province', 'text', 'Province *', 'Province', $scholars->address_province, '', '', ''
				        ) !!}

				        {!! __form::textbox(
				          '3 address_city', 'address_city', 'text', 'City/Municipality *', 'City/Municipality', $scholars->address_city, '', '', ''
				        ) !!}

				        {!! __form::textbox(
				          '6 address_specific', 'address_specific', 'text', 'Detailed address *', 'Detailed address', $scholars->address_specific, '', '', ''
				        ) !!}

				      </div>
				        

				      <div class="row">

				        {!! __form::textbox(
				          '5 address_no_years', 'address_no_years', 'number', 'Number of years living in present address *', 'Number of years living in present address', $scholars->address_no_years, '', '', 'min="0"'
				        ) !!}

				        {!! __form::textbox(
				          '3 phone', 'phone', 'text', 'Phone No. *', 'Phone No.', $scholars->phone, '', '', ''
				        ) !!}

				        {!! __form::textbox(
				          '4 citizenship', 'citizenship', 'text', 'Citizenship *', 'Citizenship', $scholars->citizenship, '', '', ''
				        ) !!}

				      </div>
				</div>
					<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_22">
					<p class="page-header-sm text-info">
				        Occupation of the scholar (Leave blank if not applicable)
				      </p>
				        
				      <div class="row">
				        {!! __form::textbox(
				          '5 occupation', 'occupation', 'text', 'Occupation', 'Occupation', $scholars->occupation, '', '', ''
				        ) !!}

				        {!! __form::textbox(
				          '7 office_name', 'office_name', 'text', 'Name of Company', 'Name of Company', $scholars->office_name, '', '', ''
				        ) !!}

				        {!! __form::textbox(
				          '7 office_address', 'office_address', 'text', 'Office Address', 'Office Address', $scholars->office_address, '', '', ''
				        ) !!}

				        {!! __form::textbox(
				          '5 office_phone', 'office_phone', 'text', 'Phone No.', 'Phone No.', $scholars->office_phone, '', '', ''
				        ) !!}
				      </div>
				      
				      <p class="page-header-sm text-info">
				        Information of Scholar's Immediate relative
				      </p>

				      
				        <div class="row">

				          <div class="col-md-4">
				            <div class="panel panel-default">
				              <div class="panel-heading">
				                Mother
				              </div>
				              <div class="panel-body">
				                <div class="row">
				                  {!! __form::textbox(
				                  '12 father_name', 'mother_name', 'text', "Mother's Name", "Mother's Name", $scholars->mother_name, '', '', ''
				                  ) !!}
				                  {!! __form::textbox(
				                  '12 mother_phone', 'mother_phone', 'text', "Phone No.", "Phone No.", $scholars->mother_phone, '', '', ''
				                  ) !!}
				                </div>
				              </div>
				            </div>
				          </div>

				          <div class="col-md-4">
				            <div class="panel panel-default">
				              <div class="panel-heading">
				                Father
				              </div>
				              <div class="panel-body">
				                <div class="row">
				                  {!! __form::textbox(
				                  '12 father_name', 'father_name', 'text', "Father's Name", "Father's Name", '', '', '', ''
				                  ) !!}
				                  {!! __form::textbox(
				                  '12 father_phone', 'father_phone', 'text', "Phone No.", "Phone No.", $scholars->father_phone, '', '', ''
				                  ) !!}
				                </div>
				              </div>
				            </div>
				          </div>

				          <div class="col-md-4">
				            <div class="panel panel-default">
				              <div class="panel-heading">
				                Spouse (Leave blank if N/A)
				              </div>
				              <div class="panel-body">
				                <div class="row">
				                  {!! __form::textbox(
				                  '12 spouse_name', 'spouse_name', 'text', "Name of Spouse", "Name of Spouse", $scholars->spouse_name, '', '', ''
				                  ) !!}
				                  {!! __form::textbox(
				                  '12 spouse_phone', 'spouse_phone', 'text', "Phone No.", "Phone No.", $scholars->spouse_phone, '', '', ''
				                  ) !!}
				                </div>
				              </div>
				            </div>
				          </div>
				        </div>
				</div>
					<!-- /.tab-pane -->
					<div class="tab-pane" id="tab_3">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry.
						Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
						when an unknown printer took a galley of type and scrambled it to make a type specimen book.
						It has survived not only five centuries, but also the leap into electronic typesetting,
						remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
						sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
						like Aldus PageMaker including versions of Lorem Ipsum.
					</div>
					<!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div>


	      
	      
	      

	      
	  </div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

		<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>



	</div>
</form>