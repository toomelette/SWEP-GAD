<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">{{$mill_district->mill_district }}</h4>
</div>
<div class="modal-body">
  {{-- {{ print("<pre>".print_r($bf_members,true)."</pre>") }} --}}
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_31" data-toggle="tab">Mill District Info</a></li>
      <li><a href="#tab_32" data-toggle="tab">Block Farm ({{$mill_district->blockFarms->count()}})</a></li>
      <li><a href="#tab_33" data-toggle="tab">Block Farm Members ({{count($bf_members)}})</a></li>
      <li><a href="#tab_34" data-toggle="tab">Scholars ({{$mill_district->scholars->count()}})</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_31">
        <div class="well well-sm bg-white">
          <div class="row">
            <div class="col-md-5">
              <dl class="dl-horizontal">
                <dt>Mill District:</dt>
                <dd>{{$mill_district->mill_district}}</dd>

                <dt>Chairman:</dt>
                <dd>{{$mill_district->chairman}}</dd>

                <dt>Location:</dt>
                <dd>{{$mill_district->loaction}}</dd>

                <dt>Region:</dt>
                <dd>{{$mill_district->region}}</dd>
              </dl>
            </div>
            <div class="col-md-7">
                <dl class="dl-horizontal">
                  <dt>Address:</dt>
                  <dd>{{$mill_district->address}}</dd>

                  <dt>MD Officer:</dt>
                  <dd>{{$mill_district->mdo}}</dd>

                  <dt>Contact No.:</dt>
                  <dd>{{$mill_district->phone}}</dd>

                </dl>
            </div>
          </div>
        </div>
      </div>
        <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_32">
        <table class="table table-bordered table-hover bg-white" id="block_farm_table">
          <thead>
            <tr>
              <th>Block Farm</th>
              <th>Source of Fund</th>
              <th>Enrolee</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($mill_district->blockFarms))
              @foreach($mill_district->blockFarms as $block_farm)
                <tr>
                  <td>{{$block_farm->block_farm_name }}</td>
                  <td>{{$block_farm->fund_source }}</td>
                  <td>{{$block_farm->enrolee_name }}</td>
                  <td>
                    <a href="{{route('dashboard.block_farm.index')}}?search={{$block_farm->slug}}" target="_blank">
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fa fa-gear"></i>
                        View | Edit | Delete
                      </button>
                    </a>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
        <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_33">
        <table class="table table-bordered table-hover bg-white" id="block_farm_members_table">
          <thead>
            <tr>
              <th>Fullname</th>
              <th>Block Farm</th>
              <th>Bday</th>
              <th>Age</th>
              <th>Sex</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($bf_members))
              @foreach($bf_members as $bf_member)
                <tr>
                  <td>{{$bf_member->lastname}}, {{$bf_member->firstname}}</td>
                  <td>{{$bf_member->blockFarm->block_farm_name}}</td>
                  <td>{{date("M. d, Y",strtotime($bf_member->bday))}}</td>
                  <td>{{\Carbon::parse($bf_member->bday)->age}}</td>
                  <td style="width: 15px">{!! __html::sex($bf_member->sex) !!}</td>
                  <td>
                    <a href="{{route('dashboard.bf_member.index')}}?search={{$bf_member->slug}}" target="_blank">
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fa fa-gear"></i>
                        View | Edit | Delete
                      </button>
                    </a>
                  </td>
                  
                </tr>
              @endforeach
            @endif
            
          </tbody>
        </table>
      </div>
        <div class="tab-pane" id="tab_34">
          <table class="table table-bordered table-hover bg-white" id="scholars_table">
            <thead>
              <tr>
                <th>Fullname | Address</th>
                <th>Scholarship</th>
                <th>Course | School</th>
                <th>Birthday | Age</th>
                <th>Sex</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($mill_district->scholars))
                @foreach($mill_district->scholars as $scholar)
                  <tr>
                    <td>
                      <div>{{$scholar->lastname }}, {{$scholar->firstname }} {{substr($scholar->middlename, 0,1) }}. 
                            <div class="table-subdetail">
                                {{$scholar->address_city}}, {{$scholar->address_province}}
                            </div>
                        </div>
                      </td>
                      <td>
                        {{$scholar->scholarship_applied }}
                      </td>
                      <td>
                        <div>{{$scholar->course_applied }}
                            <div class="table-subdetail">
                                {{$scholar->school}}
                            </div>
                        </div>
                      </td>
                      <td>
                        <div>{{ date("M. d, Y",strtotime($scholar->birth)) }}
                            <div class="table-subdetail">
                                {{\Carbon::parse($scholar->birth)->age}} year(s) old
                            </div>
                        </div>
                      </td>
                      <td style="width: 13px">
                        {!! __html::sex($scholar->sex) !!}
                      </td>
                      <td>
                        <a href="{{route('dashboard.scholars.index')}}?search={{$scholar->slug}}" target="_blank">
                          <button type="button" class="btn btn-default btn-xs">
                            <i class="fa fa-gear"></i>
                            View | Edit | Delete
                          </button>
                        </a>
                      </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
  
</div>
<div class="modal-footer">
  <div class="row">
    {!! __html::timestamps(
      $mill_district->creator['firstname'] ." ".$mill_district->creator['lastname'],
      $mill_district->created_at,
      $mill_district->updater['firstname'] ." ". $mill_district->updater['lastname'],
      $mill_district->updated_at,"5"
    ) !!} 

    <div class="col-md-2">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
  
</div>

<script type="text/javascript">
  $("#block_farm_table").DataTable({});
  $("#block_farm_members_table").DataTable({});
  $("#scholars_table").DataTable({});
</script>