@extends('layouts.modal-content')

@section('title')
  {{$mill_district->mill_district }}
@endsection


@section('body')
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#show_md" data-toggle="tab">Mill District Info</a></li>

      <li>
        <a href="#show_seminars" data-toggle="tab">
          Seminars 
          {!! __html::label_int($mill_district->seminars->count()) !!}
        </a>
      </li>

      <li>
        <a href="#show_seminars_participants" data-toggle="tab">
          Seminar Participants 
          {!! __html::label_int(count($seminar_participants))!!}
        </a>
      </li>

      <li>
        <a href="#show_bf" data-toggle="tab">
          Block Farm 
          {!! __html::label_int($mill_district->blockFarms->count()) !!}
        </a>
      </li>
      <li>
        <a href="#show_bfm" data-toggle="tab">
        Block Farm Members 
        {!! __html::label_int(count($bf_members)) !!}
        </a>
      </li>
      <li>
        <a href="#show_sch" data-toggle="tab">
          Scholars
          {!! __html::label_int($mill_district->scholars->count()) !!}
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="show_md">
        <div class="well well-sm bg-white">
          <div class="row">
            <div class="col-md-5">
              <dl class="dl-horizontal">
                <dt>Mill District:</dt>
                <dd>{{$mill_district->mill_district}}</dd>

                <dt>Chairman:</dt>
                <dd>{{$mill_district->chairman}}</dd>

                <dt>Location:</dt>
                <dd>{{$mill_district->location}}</dd>

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
        <div class="well well-sm bg-white">
          <div class="row">
            <div class="col-md-3">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <center>
                    <label>Scholars</label>  
                  </center>
                </div>
                <div class="panel-body">
                  <canvas id="scholars_m_f" width="400" height="520"></canvas>
                  <center>
                    <p>Total # of Scholars: <b>{{$mill_district->scholars->count() }} </b></p>
                  </center>
                </div>
              </div>
            </div>

            <div class="col-md-9">
              <div class="panel panel-info ">
                <div class="panel-heading">
                  <center>
                    <label>Block Farm Members</label>  
                  </center>
                </div>
                <div class="panel-body">
                  <canvas id="per_block_farm" width="400" height="150"></canvas>
                  <center>
                    <p>Total # of Block Farms: <b>{{$mill_district->blockFarms->count() }} </b>
                     |

                    Total # of Block Farm Members: <b>{{$mill_district->its_block_farm_members->count() }} </b>
                    </p>

                  </center>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
        <!-- /.tab-pane -->

      <div class="tab-pane" id="show_seminars">
        <table class="table table-bordered table-hover bg-white" id="seminars_table">
          <thead>
            <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
              <th>Title</th>
              <th>Sponsor</th>
              <th>Venue</th>
              <th>Date Covered</th>
              <th>Participants</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($mill_district->seminars))
              @foreach($mill_district->seminars as $seminar)
                <tr>
                  <td>{{$seminar->title }}</td>
                  <td>{{$seminar->sponsor }}</td>
                  <td>{{$seminar->venue }}</td>
                  <td>
                    @php
                      if($seminar->date_covered_from == $seminar->date_covered_to ){
                        echo date("M. d, Y",strtotime($seminar->date_covered_from));
                       }else{
                        echo date("M. d, Y",strtotime($seminar->date_covered_from)).' - '.date("M. d, Y",strtotime($seminar->date_covered_to));
                       }
                    @endphp
                  </td>
                  <td class="text-center">
                    {{$seminar->seminarParticipant->count() }} 
                    (
                      <span class="text-red">
                        <i class="fa fa-female"></i> = {{$seminar->seminarParticipant_female->count() }} 
                      </span>
                      ,

                      <span class="text-green">
                      <i class="fa fa-male"></i> = {{$seminar->seminarParticipant_male->count() }} 
                      </span>
                    )
                  </td>
                  <td>
                    <a href="{{route('dashboard.seminar.index')}}?search={{$seminar->slug}}" target="_blank">
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

      
      <div class="tab-pane" id="show_seminars_participants">
        <table class="table table-bordered table-hover bg-white" id="seminar_participants_table" style="width: 100% !important">
          <thead>
            <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
              <th>Seminar</th>
              <th>Name</th>
              <th>Address</th>
              <th>Contact no.</th>
              <th>Email</th>
              <th>Sex</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($seminar_participants))
              @foreach($seminar_participants as $participant)
                <tr>
                  <td>
                    {{$participant->seminar->title}} - 
                    ({{$participant->seminar->seminarParticipant->count()}} total) 
                  </td>
                  <td>{{$participant->fullname }}</td>
                  <td>{{$participant->address }}</td>
                  <td class="text-center">{{$participant->contact_no or 'N/A' }}</td>
                  <td class="text-center">{{$participant->email or 'N/A' }}</td>
                  <td style="width: 15px">{!! __html::sex($participant->sex) !!}</td>
                  <td style="width: 30px">
                    <a href="{{route('dashboard.seminar.index')}}?search={{$participant->seminar->slug}}" target="_blank">
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fa fa-gear"></i>
                        View seminar
                      </button>
                    </a>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>

      <div class="tab-pane" id="show_bf">
        <table class="table table-bordered table-hover bg-white" id="block_farm_table">
          <thead>
            <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
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
                  <td style="width: 35px">
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



      <div class="tab-pane" id="show_bf">
        <table class="table table-bordered table-hover bg-white" id="block_farm_table">
          <thead>
            <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
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
                  <td style="width: 35px">
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
      <div class="tab-pane" id="show_bfm">
        <table class="table table-bordered table-hover bg-white" id="block_farm_members_table" style="width: 100% !important">
          <thead>
            <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
              <th>Block Farm</th>
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
                  <td>
                    {{$bf_member->blockFarm->block_farm_name}} 
                    - 
                    {{$bf_member->blockFarm->blockFarmMembers->count()}} member(s)
                  </td>
                  <td>{{$bf_member->lastname}}, {{$bf_member->firstname}}</td>
                  <td>{{$bf_member->blockFarm->block_farm_name}}</td>
                  <td>{{date("M. d, Y",strtotime($bf_member->bday))}}</td>
                  <td style="width: 15px" class="text-center">{{\Carbon::parse($bf_member->bday)->age}}</td>
                  <td style="width: 15px">{!! __html::sex($bf_member->sex) !!}</td>
                  <td style="width: 35px">
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
      <div class="tab-pane" id="show_sch">
        <table class="table table-bordered table-hover bg-white" id="scholars_table">
          <thead>
            <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
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
                    <td style="width: 35px">
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
    </div>
  </div>
  
@endsection


@section('footer')

  <div class="row">
    {!! __html::timestamp($mill_district ,"5") !!} 

    <div class="col-md-2">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

@endsection


@section('script')
<script type="text/javascript">

    $('#scholars_table').DataTable({});
    $('#seminars_table').DataTable({});
    $('#block_farm_table').DataTable({});
    $('#seminar_participants_table').DataTable({
      'rowGroup': {
        'dataSrc': 0
      },
      'columnDefs':[
        {
          'targets': 0,
          'visible': false
        }
      ]
    });
    $('#block_farm_members_table').DataTable({
      'rowGroup': {
        'dataSrc': 0
      },
      'columnDefs':[
        {
          'targets': 0,
          'visible': false
        }
      ]
    });

    $(document).ready(function(){
      var ctx = $('#per_block_farm');
      var scholars = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            @foreach($mill_district->blockFarms as $block_farm)

              @if(strlen($block_farm->block_farm_name) > 20)
                '{{ 
                  substr($block_farm->block_farm_name, 0, 14) }}...{{
                    substr(
                    $block_farm->block_farm_name, 
                    strlen($block_farm->block_farm_name)-5, 
                    strlen($block_farm->block_farm_name))
                  }}',
              @else
                '{{ $block_farm->block_farm_name }}',
              @endif
              
            @endforeach
          ],

          datasets: [
              {
                data: [
                  @foreach($mill_district->blockFarms as $block_farm)
                    '{{
                      $block_farm->blockFarmMembers
                      ->where("sex","=","FEMALE")
                      ->count() 
                    }}',
                  @endforeach
                ],
                label: 'FEMALE',
                backgroundColor: 'rgb(255,105,180)',
              },
              {
                data: [
                  @foreach($mill_district->blockFarms as $block_farm)
                    '{{
                      $block_farm->blockFarmMembers
                      ->where("sex","=","MALE")
                      ->count() 
                    }}',
                  @endforeach
                ],
                label: 'MALE',
                backgroundColor: 'rgb(60,179,113)',
              }
            ]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      },
                      stacked: true,
                  }],
                  xAxes: [{ stacked: true }],
              }
          }
      });
      var scholars_pie = new Chart($("#scholars_m_f"), {
        type: 'pie',
        data: {
          datasets: [
            {
              data: [{{$mill_district->scholars_male->count()}}, {{$mill_district->scholars_female->count()}}],
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


    })
</script>
@endsection