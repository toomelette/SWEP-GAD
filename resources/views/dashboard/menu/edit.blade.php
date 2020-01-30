<form id="edit_menu_form" autocomplete="off" data="{{$menu->slug}}">
  @csrf
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="fa {{$menu->icon}}"></i> {{$menu->name}}</h4>
  </div>
  <div class="modal-body">
    <div class="row">
      {!! __form::textbox(
        '12 name', 'name', 'text', 'Name: *', 'Name',$menu->name, '', '', ''
      ) !!}

      {!! __form::textbox(
        '12 route', 'route', 'text', 'Route: *', 'Route',$menu->route, '', '', ''
      ) !!}

      {!! __form::textbox(
        '12 category', 'category', 'text', 'Category: *', 'Category',$menu->category, '', '', ''
      ) !!}

      {!! __form::textbox_icon(
        '12 icon', 'icon', 'text', 'Icon: *', 'Icon',$menu->icon, '', '', ''
      ) !!}

      {!! __form::select_static(
        '6 is_menu', 'is_menu', 'Is menu: *', $menu->is_menu, [
          'No' => '0',
          'Yes' => '1',             
        ], '', '', '', ''
      ) !!}

      {!! __form::select_static(
        '6 is_dropdown', 'is_dropdown', 'Is dropdown: *',$menu->is_dropdown, [
          'No' => '0',
          'Yes' => '1',             
        ], '', '', '', ''
      ) !!}
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save</button>
  </div>
</form>