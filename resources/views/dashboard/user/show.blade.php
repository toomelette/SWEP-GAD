<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">{{ $user->firstname }} {{ $user->lastname }}</h4>
</div>
<div class="modal-body">
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
            <label>
              {{ $menu->menu->name }}
            </label>
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
    {!! __html::timestamps(
      $user->creator['firstname'] ." ".$user->creator['lastname'],
      $user->created_at,
      $user->updater['firstname'] ." ". $user->updater['lastname'],
      $user->updated_at,"4"
    ) !!} 
    <div class="col-md-4">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>