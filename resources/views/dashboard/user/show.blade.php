<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">{{ $user->firstname }} {{ $user->lastname }}</h4>
</div>
<div class="modal-body">
  
  @php
  $submenus = [];
  
    foreach ($menus as $key => $sub){
      $submenus[$sub->menu_id] = [];
      $submenus[$sub->menu_id]['name'] = $sub->name;
      $submenus[$sub->menu_id]['menu_id'] = $sub->menu_id;
      $submenus[$sub->menu_id]['user_uses'] = 0;
      $submenus[$sub->menu_id]['all_submenu'] = count($sub->submenu);

      if($sub->submenu->isNotEmpty()){
        foreach($sub->submenu as $key2 => $submenu){
          $submenus[$sub->menu_id]['submenus'][$submenu->submenu_id] = $submenu->name;
        }
      }

    }

    foreach($user->userMenu as $menu){
      if(!empty($menu->menu)){
        foreach($user->userSubmenu as $submenu){
          if(!empty($submenu->subMenuContent) && !empty($menu->menu)){
            if($menu->menu->menu_id == $submenu->subMenuContent->menu_id){
              if(isset($submenus[$menu->menu->menu_id]['submenus'][$submenu->subMenuContent->submenu_id])){
                $submenus[$menu->menu->menu_id]['user_uses'] = $submenus[$menu->menu->menu_id]['user_uses'] +1;
              }
            }
          }
        }
      }
    }

  //print('<pre>'.print_r($submenus,true).'</pre>');
  @endphp
  <div class="row">
    <div class="col-md-3">
      <div class="well well-sm">
        <dl >
          <dt>Username:</dt>
          <dd>{{$user->username}}</dd>

          <dt>Last Name:</dt>
          <dd>{{$user->lastname}}</dd>

          <dt>First Name:</dt>
          <dd>{{$user->firstname}}</dd>

          <dt>Middle Name:</dt>
          <dd>{{$user->middlename}}</dd>

          <dt>Position:</dt>
          <dd>{{$user->position}}</dd>
          <hr class="sm-margin">

          <dt>Status:</dt>
          <dd>
            @if ($user->is_online == 1)
              <span class="label bg-green">ONLINE</span>
            @else
              <span class="label bg-gray">OFFLINE</span>
            @endif
          </dd>

          <dt>Account Status:</dt>
          <dd>
            @if ($user->is_active == 1)
              <span class="label bg-green">ACTIVE</span>
            @else
              <span class="label bg-red">INACTIVE</span>
            @endif
          </dd>
          <hr class="sm-margin">

          <dt>Last Login:</dt>
          <dd>{{date("M. d, Y | h:i A",strtotime($user->last_login_time))}}</dd>

          <dt>Last Login Machine:</dt>
          <dd>{{$user->last_login_machine}}</dd>
        </dl>
      </div>
    </div>
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          User routes
        </div>
        <div class="panel-body">
          @if(($user->userMenu)->isEmpty())
            <div class="alert alert-info">
                No routes for this user.
            </div>
          @endif
          @foreach($user->userMenu as $menu)
          {{-- <div class="well well-sm"> --}}
            @if(!empty($menu->menu))
            <div class="row">
              <div class="col-md-8">
                <label>
                  {{-- {{$menu->menu->slug}} --}}
                  {{ $menu->menu->name }}

                  @php

                  @endphp
        
                </label>
              </div>
              <div class="col-md-4">
                <div class="progress xs">
                  @php
                  $width = 0;
                  if($submenus[$menu->menu->menu_id]['all_submenu'] != 0){
                    $width = $submenus[$menu->menu->menu_id]['user_uses']/$submenus[$menu->menu->menu_id]['all_submenu']*100;
                  }else{
                    $width = 100;
                  }
                  
                  @endphp
                  <div class="progress-bar {{__static::bg_color(Auth::user()->color)}}" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width:{{$width}}%">
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              @foreach($user->userSubmenu as $submenu)
                @if(!empty($submenu->subMenuContent) && !empty($menu->menu))
                  @if($menu->menu->menu_id == $submenu->subMenuContent->menu_id)

                    <div class="col-md-4">
                       <li>
                        {{ str_replace($menu->menu->name, '', $submenu->subMenuContent->name) }}
                      </li>
                    </div>
                  @endif
                @endif
              @endforeach
            </div>
            <hr class="sm-margin">

          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <div class="row">
    {!! __html::timestamp($user ,"4") !!}
    <div class="col-md-4">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>