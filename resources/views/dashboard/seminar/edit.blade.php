


  <div class="row">
    <div class="col-md-12">
        <code class="pull-right">Fields with asterisks(*) are required</code>
    </div>
  </div>

  <form id="edit_seminar_form" autocomplete="off">
    @csrf 
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          {!! __form::textbox(
            '12 title', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $seminar->title, $errors->has('title'), $errors->first('title'), ''
          ) !!}
        </div>
        <div class="row">
          {!! __form::textbox(
            '6 sponsor', 'sponsor', 'text', 'Sponsor *', 'Sponsor', old('sponsor') ? old('sponsor') : $seminar->sponsor, $errors->has('sponsor'), $errors->first('sponsor'), ''
          ) !!}

          {!! __form::textbox(
            '6 venue', 'venue', 'text', 'Venue *', 'Venue', old('venue') ? old('venue') : $seminar->venue, $errors->has('venue'), $errors->first('venue'), ''
          ) !!}
        </div>
        <div class="row">
          {!! __form::datepicker(
            '6 date_covered_from', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : __dataType::date_parse($seminar->date_covered_from), $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ) !!}

          {!! __form::datepicker(
            '6 date_covered_to', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : __dataType::date_parse($seminar->date_covered_to), $errors->has('date_covered_to'), $errors->first('date_covered_to')
            ) !!} 
        </div>

      </div> 
      <div class="col-md-5">
        {!! __form::file(
          '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
        ) !!}
      </div>
    </div>

    

    <div class="col-md-12" style="padding-top:30px;">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Add Speakers</h3>
          <button id="add_row_edit" type="button" class="btn btn-sm bg-green pull-right">Add Speaker &nbsp;<i class="fa fw fa-plus"></i></button>
        </div>

        <div class="box-body no-padding">
          <table class="table table-bordered">
            <tr>
              <th>Fullname *</th>
              <th>Topic</th>
              <th style="width: 40px"></th>
            </tr>
            <tbody id="table_body">
            

              @foreach($seminar->seminarSpeaker as $key => $data)
              <tr>
                <td>
                  {!! __form::textbox_for_dt('row['. $key .'][spkr_fullname]', 'Fullname', $data->fullname, '') !!}
                </td>

                <td>
                  {!! __form::textbox_for_dt('row['. $key .'][spkr_topic]', 'Topic', $data->topic, '') !!}
                </td>
                <td>
                  <button type="button" class="btn btn-sm bg-red delete_row_edit"><i class="fa fa-times"></i></button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-fw fa-save"></i> Save changes</button>
      </div>
    </div>     
  </form>



