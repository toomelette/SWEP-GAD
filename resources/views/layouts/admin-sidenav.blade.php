<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{!! __html::check_img(Auth::user()->image) !!}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        
        @if(Auth::check())
          <p>{{ Auth::user()->firstname }}</p>
        @endif

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      

      @if(Auth::check())

      {{-- User --}}
        @if(!$global_user_menus->isEmpty())
            <li class="header">NAVIGATION</li>

            @foreach($global_user_menus as $user_menu)
              @if(!empty($user_menu->menu->is_menu))
                @if($user_menu->menu->is_menu == true)
                 @if($user_menu->menu->is_dropdown == false)
                  <li class="{!! Route::currentRouteNamed($user_menu->menu->route) ? 'active' : '' !!}">
                    <a href="{{ route($user_menu->menu->route) }}">
                      <i class="fa {{ $user_menu->menu->icon }}"></i> <span>{{ $user_menu->menu->name }}</span>
                    </a>
                  </li>
                  @else
                    <li class="treeview {!! Route::currentRouteNamed($user_menu->menu->route) ? 'active' : '' !!}">
                      <a href="#">
                        <i class="fa {{ $user_menu->menu->icon }}"></i> <span>{{ $user_menu->menu->name }}</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>

                        <ul class="treeview-menu">

                          @foreach($user_menu->userSubMenu as $user_nav)
                            @if(!empty($user_nav->subMenu))
                              @if($user_nav->subMenu->is_nav == true)

                                <li class="{!! Route::currentRouteNamed($user_nav->subMenu->route) ? 'active' : '' !!}">
                                  <a href="{{ route($user_nav->subMenu->route) }}"><i class="fa fa-caret-right"></i> {{ $user_nav->subMenu->nav_name }}</a>
                                </li>

                              @endif
                            @endif
                          @endforeach

                        </ul>

                    </li>         
                  @endif
                @else
              @endif
              @endif
            @endforeach
           

          @endif


            
        @endif

    </ul>
  </section>
</aside>