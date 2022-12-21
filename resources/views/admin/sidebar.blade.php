      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}"> <img alt="image" src="/admin/assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">Avto</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <!-- @role('admin') -->
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user-check"></i><span>Adminstratsiya</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.users.index') }}">Adminlar</a></li>
                <li><a class="nav-link" href="#">Roles</a></li>
                <li><a class="nav-link" href="widget-data.html">Permissions</a></li>
              </ul>
            </li>
            <!-- @endrole -->
            <li class="dropdown">
              <a href="{{ route('admin.shops.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Magazinlar</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin.warehouses.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Omborlar</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin.products.index')}}" class="nav-link"><i data-feather="monitor"></i><span>Tavarlar</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin.orders.index')}}" class="nav-link"><i data-feather="monitor"></i><span>Zakazlar</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link"><i data-feather="monitor"></i><span>Hodimlar</span></a>
            </li>
          </ul>
        </aside>
      </div>
