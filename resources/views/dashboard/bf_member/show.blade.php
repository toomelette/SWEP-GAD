<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">{{ $bf_member->lastname }}, {{ $bf_member->firstname }}</h4>
  </div>
  <div class="modal-body">
  	<div class="nav-tabs-custom">
  		<ul class="nav nav-tabs">
  			<li class="active"><a href="#tab_31" data-toggle="tab">Farmer information</a></li>
  			<li><a href="#tab_32" data-toggle="tab">Family Members</a></li>
  		</ul>
  		<div class="tab-content">
  			<div class="tab-pane active" id="tab_31">
  				<div class="well well-sm bg-white">
            <div class="row">
              <div class="col-md-6">
                <dl class=" dl-horizontal">
                  <dt>Last Name:</dt>
                  <dd>{{$bf_member->lastname}}</dd>

                  <dt>First Name:</dt>
                  <dd>{{$bf_member->firstname}}</dd>

                  <dt>Middle Name:</dt>
                  <dd>{{$bf_member->middlename}}</dd>

                  <dt>Birthday:</dt>
                  <dd>{{date("M. d, Y", strtotime($bf_member->bday))}}</dd>

                  <dt>Age:</dt>
                  <dd>{{$bf_member->age}} year(s) old</dd>

                  <dt>Sex:</dt>
                  <dd>{{$bf_member->sex}}</dd>

                  <dt>Civil Status:</dt>
                  <dd>{{$bf_member->civil_status}}</dd>

                </dl>
              </div>

              <div class="col-md-6">
                <dl class=" dl-horizontal">
                  <dt>Educational Att.:</dt>
                  <dd>{{$bf_member->educ_att}}</dd>

                  <dt>Sugarcane Farming:</dt>
                  <dd>{{$bf_member->years_sugarcane_farming}} year(s)</dd>

                  <dt>Tenurial Status:</dt>
                  <dd>{{$bf_member->tenurial}}</dd>

                  <dt>No. of Family Members:</dt>
                  <dd>{{$bf_member->maleFamilyMembers->count() + $bf_member->femaleFamilyMembers->count()}}</dd>

                  <dt>Male Family Members:</dt>
                  <dd>{{$bf_member->maleFamilyMembers->count()}}</dd>

                  <dt>Female Family Members:</dt>
                  <dd>{{$bf_member->femaleFamilyMembers->count()}}</dd>

                </dl>
              </div>
            </div>
          </div>
  			</div>
  				<!-- /.tab-pane -->
  				<div class="tab-pane" id="tab_32">
  					@if(!empty($bf_member->familyMembers))
              @if($bf_member->familyMembers->count() > 0)
                <table class="table table-bordered bg-white">
                  <thead>
                    <tr>
                      <th>Fullname</th>
                      <th>Sex</th>
                      <th>Birthday</th>
                      <th>Age</th>
                      <th>Civil Status</th>
                      <th>Economic Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($bf_member->familyMembers as $familyMember)
                      <tr>
                        <td>
                          {{$familyMember->lastname}} , 
                          {{$familyMember->firstname}}
                          {{$familyMember->middlename}}
                        </td>
                        <td>
                          {{$familyMember->sex}}
                        </td>
                        <td>
                          {{$familyMember->bday}}
                        </td>
                        <td>
                          {{\Carbon::parse($familyMember->bday)->age}} 
                        </td>
                        <td>
                          {{$familyMember->civil_status}}
                        </td>
                        <td>
                          {{$familyMember->eco_status}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @else
                <div class="callout callout-success">
                  <h4>No family members added to {{$bf_member->firstname}}</h4>

                  <p>You can add using edit button found on the table.</p>
                </div>
              @endif
            @endif
  				</div>
  				<!-- /.tab-pane -->
  			</div>
  			<!-- /.tab-content -->
  		</div>
    </div>
  <div class="modal-footer">
  	<div class="row">
  		{!! __html::timestamps(
  			$bf_member->creator['firstname'] ." ".$bf_member->creator['lastname'],
  			$bf_member->created_at,
  			$bf_member->updater['firstname'] ." ". $bf_member->updater['lastname'],
  			$bf_member->updated_at,"4"
  		)!!}	
		<div class="col-md-4">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
    
  </div>
</div>