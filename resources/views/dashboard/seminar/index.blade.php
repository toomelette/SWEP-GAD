<?php

  $table_sessions = [ Session::get('SEMINAR_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),
                      ];

?>





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Manage Seminars</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.seminar.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.seminar.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('title', 'Title')</th>
            <th>@sortablelink('sponsor', 'Sponsor')</th>
            <th>@sortablelink('venue', 'Venue')</th>
            <th>@sortablelink('date_covered_from', 'Date From')</th>
            <th>@sortablelink('date_covered_to', 'Date To')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($seminars as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td>{{ $data->title }}</td>
              <td>{{ $data->sponsor }}</td>
              <td>{{ $data->venue }}</td>
              <td>{{ __dataType::date_parse($data->date_covered_from, 'F d,Y') }}</td>
              <td>{{ __dataType::date_parse($data->date_covered_to, 'F d,Y') }}</td>
              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.seminar.participant', $data->slug) }}">Participants</option>
                  <option data-type="1" data-url="{{ route('dashboard.seminar.speaker', $data->slug) }}">Speakers</option>
                  <option data-type="1" data-url="{{ route('dashboard.seminar.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.seminar.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($seminars->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($seminars) !!}
        {!! $seminars->appends($appended_requests)!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('seminar_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::modal_confirm_delete_caller('seminar_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('SEMINAR_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('SEMINAR_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('SEMINAR_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('SEMINAR_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection