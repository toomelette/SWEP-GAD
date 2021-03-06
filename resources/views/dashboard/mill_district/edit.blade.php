@extends('layouts.modal-content')

@section('form-open')
  <form id="edit_mill_district_form" autocomplete="off" data="{{$mill_district->slug}}">
@endsection


@section('title')
  {{$mill_district->mill_district }}
@endsection


@section('body')
  <div class="row">
    @csrf
    {!! __form::select_static(
            '12 location', 'location', 'Location *', $mill_district->location, 
              $locations
            , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
    ) !!}

    {!! __form::select_static(
      '12 region', 'region', 'Region *', 
      $mill_district->region, 
      $regions_under_location
      , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
    ) !!}

    {!! __form::textbox(
      '12 mill_district', 'mill_district', 'text', 'Mill District *', 'Mill District', $mill_district->mill_district, '', $errors->first('title'), 'style="text-transform: uppercase"'
    ) !!}

    {!! __form::textbox(
      '12 chairman', 'chairman', 'text', 'Chairman *', 'Chairman', $mill_district->chairman, '', $errors->first('title'), ''
    ) !!}

    {!! __form::textbox(
      '12 address', 'address', 'text', 'Address *', 'Address', $mill_district->address, '', $errors->first('title'), ''
    ) !!}

    {!! __form::textbox(
      '12 mdo', 'mdo', 'text', 'Mill District Officer *', 'Mill District Officer', $mill_district->mdo, '', $errors->first('title'), ''
    ) !!}

    {!! __form::textbox(
      '12 phone', 'phone', 'text', 'Contact number *', 'Contact number', $mill_district->phone, '', $errors->first('title'), ''
    ) !!}

  </div>
@endsection


@section('footer')
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} add_block_farm_btn"><i class="fa fa-save"> </i> Save</button>
@endsection

@section('form-close')
  </form>
@endsection

  