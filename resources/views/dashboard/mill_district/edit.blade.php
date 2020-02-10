
<form id="edit_mill_district_form" autocomplete="off" data="{{$mill_district->slug}}">
    
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span></button>
      <h4 class="modal-title">Add Mill District</h4>
    </div>
    <div class="modal-body">
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
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary add_block_farm_btn"><i class="fa fa-save"> </i> Save</button>
    </div>
  </form>