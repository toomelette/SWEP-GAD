<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">{{ $seminar->title }} - Participants</h4>
</div>
<div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="well well-sm">
          <form id="add_participant_form" autocomplete="off">
            @csrf
            <p class="text-center"> <b>ADD PARTICIPANTS</b> </p>
            <div class="row">
              {!! __form::textbox(
                 '4 fullname', 'fullname', 'text', 'Fullname *', 'Fullname', old('fullname'), $errors->has('fullname'), $errors->first('fullname'), ''
              ) !!}

              {!! __form::textbox(
                 '5 address', 'address', 'text', 'Address', 'Address', old('address'), $errors->has('address'), $errors->first('address'), ''
              ) !!}

              {!! __form::select_static(
                '3 sex', 'sex', 'Sex *', old('sex'), ['MALE' => 'MALE', 'FEMALE' => 'FEMALE'], $errors->has('sex'), $errors->first('sex'), '', ''
              ) !!}
            </div>
            <div class="row">
              {!! __form::textbox(
                 '6 contact_no', 'contact_no', 'text', 'Contact No.', 'Contact No.', old('contact_no'), $errors->has('contact_no'), $errors->first('contact_no'), ''
              ) !!}

              {!! __form::textbox(
                 '6 email', 'email', 'text', 'Email', 'Email', old('email'), $errors->has('email'), $errors->first('email'), ''
              ) !!} 
            </div>  
            <div class="row">
              <div class="col-md-2 pull-right">
                <button type="submit" class="btn btn-primary col-md-12 add_participant_btn">Save <i class="fa fa-fw fa-save"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  
  <hr class="no-margin">
  <div class="row">
    <div class="col-md-12">
      <br>
      <p class="text-center no-margin"> <b>PARTICIPANTS</b> </p>
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
          <tr>
            <th>Fullname</th>
            <th>Address</th>
            <th style="width: 10%">Sex</th>
            <th>Contact No.</th>
            <th>Email</th>
            <th style="width: 10%">Action</th>
          </tr>
        </thead>
        <tbody>
          
          @foreach($seminar->seminarParticipant as $data) 
            <tr id="{{ $data->slug }}">
              <td>{{ $data->fullname }}</td>
              <td>{{ $data->address }}</td>
              <td>{{ $data->sex }}</td>
              <td>{{ $data->contact_no }}</td>
              <td>{{ $data->email }}</td>
              <td>
                <div class="btn-group">
                  <button  data="{{$data->slug}}" class="btn btn-sm btn-default edit_participant_btn">
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

