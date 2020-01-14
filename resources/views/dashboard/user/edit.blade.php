<form id="edit_user_form" data="{{ $user->slug}}">

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">{{ $user->lastname }}, {{ $user->firstname }}</h4>
  </div>
  <div class="modal-body">
   @php
      $this_user_has = [];
      foreach ($user->userSubmenu as $menu) {
          array_push($this_user_has, $menu->submenu_id);
       
      }
      //print_r($this_user_has);
      $this_user_has = collect($this_user_has);

    @endphp

    <div class="box-body">                  
      

      <div class="row">
          {!! __form::textbox(
            '4 firstname', 'firstname', 'text', 'Firstname *', 'Firstname', $user->firstname, 'e_firstname', '', ''
          ) !!}

          {!! __form::textbox(
            '4 middlename', 'middlename', 'text', 'Middlename *', 'Middlename',  $user->middlename, 'e_middlename', '', ''
          ) !!}

          {!! __form::textbox(
            '4 lastname', 'lastname', 'text', 'Lastname *', 'Lastname',  $user->lastname, 'e_lastname', '', ''
          ) !!}

      </div>

      <div class="row">
          {!! __form::textbox(
            '6 email', 'email', 'email', 'Email *', 'Email', $user->email, 'e_email', '', ''
          ) !!}

          {!! __form::textbox(
            '6 position', 'position', 'text', 'Position *', 'Position',  $user->position, 'e_position', '', ''
          ) !!}
      </div>



      <div class="row">
        <div class="col-sm-12">
          <h4>User Menu 
            <span class="pull-right ">
              <small class="text-info">You can use CTRL & SHIFT keys for multiple selection. CTRL+A to select all.</small>
            </span>
           </h4>
          <hr style="margin: 0 0 10px 0">
        </div>

        @foreach ($menus as $key => $sub)
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa {{ $sub->icon }}"></i>
              {{ $sub->name }}
              <div class="pull-right">
                <button class="btn btn-xs btn-default clear_btn" type="button">Clear</button>
              </div>
            </div>
            <div class="panel-body" style="min-height: 180px">
              <div class="row">
                <div class="col-sm-12">
                  @if($sub->submenu->isEmpty())
                  <center>
                    <label>No submenu found for this Menu</label>
                  </center>
                    
                  @else
                    <select multiple name="menu[{{$sub->menu_id}}][]" class="form-control select_multiple" size="6">                   
                          @foreach($sub->submenu as $key2 => $submenu)
                           <option value="{{$submenu->submenu_id}}".
                            @if ($this_user_has->contains($submenu->submenu_id))
                              selected="" 
                            @endif
                            >
                            {{ str_replace($sub->name,'', $submenu->name) }}
                          </option>                            
                          @endforeach                               
                      
                    </select>
                    <span class="help-block">No module selected</span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary update_user_btn"><i class="fa fa-save fa-fw"></i> Save</button>
  </div>
</form>