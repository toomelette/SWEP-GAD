<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">{{ $seminar->title }} - Participants</h4>
</div>
<div class="modal-body">

  <div class="row">
    <div class="col-md-12">
      <p class="text-center no-margin"> <b>PARTICIPANTS</b> </p>
      <button class="pull-right btn {!! __static::bg_color(Auth::user()->color) !!} btn-sm" data-toggle="modal" data-target="#add_participant_modal"><i class="fa fa-plus"></i> Add Participant</button>
      <p class="text-center no-margin"> 
        <b>
          {{ $seminar->title }} 
          |

            @if($seminar->date_covered_from != $seminar->date_covered_to)
              {{date("F d, Y",strtotime($seminar->date_covered_from))}} to {{date("F d, Y",strtotime($seminar->date_covered_to))}}
            
            @else
              {{date("F d, Y",strtotime($seminar->date_covered_from))}}
            
            @endif


        </b>
      </p>

      <br>
      <table class="table table-hover table-bordered" id="participant_tbl" style="width: 100% !important">

        <thead>
          <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
            <th>Fullname</th>
            <th>Occupation</th>
            <th style="width: 5%">Age</th>
            <th style="width: 10%">Status</th>
            <th style="width: 10%">Educational Att.</th>
            <th>Contact No.</th>
            <th style="width: 7%">Children</th>
            <th style="width: 5%">Sex</th>
            <th style="width: 8%">Action</th>
          </tr>
        </thead>
        <tbody>
          
          @foreach($seminar->seminarParticipant as $data) 
            <tr id="{{ $data->slug }}">
              <td>{{ $data->fullname }}</td>
              <td>{{ $data->occupation }}</td>
              <td>{{ $data->age }}</td>
              <td>{{ $data->civil_status }}</td>
              <td>{{ $data->educ_att }}</td>
              <td>{{ $data->contact_no }}</td>
              <td>{{ $data->no_children }}</td>
              <td>{!! __html::sex($data->sex) !!}</td>

              <td>
                <div class="btn-group">
                  <button data-toggle="modal" data-target="#edit_participant_modal" data="{{$data->slug}}" class="btn btn-sm btn-default edit_participant_btn">
                    <i class="fa fa-pencil-square-o"></i>
                  </button>
                  <button data="{{$data->slug}}" class="btn btn-sm btn-danger delete_participant_btn">
                    <i class="fa  fa-trash-o"></i>
                  </button>
                </div>
              </td>
            </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

