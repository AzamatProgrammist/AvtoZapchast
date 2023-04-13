      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="/"> <img alt="image" src="/admin/assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">Avto</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            @role('Adminstrator')
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user-check"></i><span>{{ __('words.admin')}}</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.users.index') }}">@lang('words.admins')</a></li>
                <li><a class="nav-link" href="{{ route('admin.roles.index') }}">@lang('words.roles')</a></li>
               <!--  <li><a class="nav-link" href="{{ route('admin.permissions.index') }}">@lang('words.permissions')</a></li> -->
              </ul>
            </li>
            @endrole
            <li class="dropdown">
              <a href="/" class="nav-link"><i data-feather="shopping-bag"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin.shops.index') }}" class="nav-link"><i data-feather="shopping-bag"></i><span>@lang('words.shops')</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin.warehouses.index') }}" class="nav-link"><i data-feather="database"></i><span>@lang('words.warehouses')</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin.products.index')}}" class="nav-link"><i class="ion-model-s"></i><span>@lang('words.products')</span></a>
            </li>
            @hasanyrole('Adminstrator|Manager')
            <li class="dropdown">
              <a href="{{ route('admin.main_orders.index')}}" class="nav-link"><i data-feather="archive"></i><span>{{ __('words.orders') }}</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin.orders_to_foreigners.index')}}" class="nav-link"><i data-feather="archive"></i><span>{{ __('words.foreignOrder') }}</span></a>
            </li>
             <li class="dropdown">
              <a href="{{ route('admin.inkassa.index')}}" class="nav-link"><i data-feather="dollar-sign"></i><span>@lang('words.payments')</span></a>
            </li>
            @endhasanyrole
            <li class="dropdown">
              <a href="{{ route('admin.employees.index') }}" class="nav-link"><i data-feather="users"></i><span>{{ __('words.workers') }}</span></a>
            </li>
          </ul>
        </aside>
      </div>

