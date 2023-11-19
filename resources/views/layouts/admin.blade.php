<!DOCTYPE html>
<html lang="en">
<?php
  use App\Models\Cart;
  use App\Models\Carts_to_foreigners;
  $count1 = Cart::all()->count();
  $count2 = Carts_to_foreigners::all()->count();
  if ($count1 == 0 && $count2 == 0) {
    $count = 0;
  }elseif ($count1 > 0 && $count2 == 0) {
    $count = $count1;
  }else{
    $count = $count2;
  }

?>

<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="csrf-token" content="content">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <title>@yield('title') - Admin panel</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/admin/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/admin/assets/css/style.css">
  <link rel="stylesheet" href="/admin/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/admin/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/admin/assets/img/favicon.ico' />
  <link rel="stylesheet" href="/admin/assets/bundles/ionicons/css/ionicons.min.css">

  <link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/prism/prism.css">


  <link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="/admin/assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="/admin/assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="/admin/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

  @yield('css')
</head>
<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        
      <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle">
            <a href="/lang/uz" class="nav-link" style="color: black;">UZB</a>
          </li>
          <li class="dropdown dropdown-list-toggle">
            <a href="/lang/ru" class="nav-link" style="color: black;">Rус</a>
          </li>
          <li class="dropdown dropdown-list-toggle">
            <a href="/lang/en" class="nav-link" style="color: black;">ENG</a>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="{{ route('admin.carts.index') }}" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle">
              <i class="ion-android-cart" data-pack="android" data-tags="" style="color: black; font-size: 25px"></i>
              
              <span class="badge headerBadge1">
                {{ $count }} 
              </span> </a>

            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              @if($count1 > 0)
                <a href="{{ route('admin.carts.index') }}" class="dropdown-item"> <span class="dropdown-item-avatar
                      text-white"> <img alt="image" src="/admin/assets/img/users/user-1.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">{{ auth()->user()->name }}</span>
                  </span><span></span>
                </a> 
              @endif
              
              @if($count2 > 0)
                <a href="{{ route('admin.carts_to_foreigners.index') }}" class="dropdown-item"> <span class="dropdown-item-avatar
                      text-white"> <img alt="image" src="/admin/assets/img/users/user-1.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">{{ auth()->user()->name }}</span>
                  </span><span></span>
                </a>
              @endif
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread"> <span
                    class="dropdown-item-icon bg-primary text-white"> <i class="fas
                        fa-code"></i>
                  </span> <span class="dropdown-item-desc"> Template update is
                    available now! <span class="time">2 Min
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
                        fa-user"></i>
                  </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                      Sugiharto</b> are now friends <span class="time">10 Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i
                      class="fas
                        fa-check"></i>
                  </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                    moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                      Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i
                      class="fas fa-exclamation-triangle"></i>
                  </span> <span class="dropdown-item-desc"> Low disk space. Let's
                    clean it! <span class="time">17 Hours Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
                        fa-bell"></i>
                  </span> <span class="dropdown-item-desc"> Welcome to Otika
                    template! <span class="time">Yesterday</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="/admin/assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">{{ auth()->user()->name }}</div>
              <a href="profile.html" class="dropdown-item has-icon"> <i class="far
                    fa-user"></i> Profile
              </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Activities
              </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <form action="{{ route('logout') }}" method="POST">
                @csrf  
                <button type="submit" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i>Logout</button>
              </form>
            </div>
          </li>
        </ul>
      </nav>

@include('admin.sidebar')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('content')
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          <a target="__blank" href="https://proconnect.uz/">Proconnect.uz</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="/admin/assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="/admin/assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="/admin/assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="/admin/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="/admin/assets/js/custom.js"></script>
  <!-- ijaboCropTool -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <!-- JS Libraies -->
  <script src="/admin/assets/bundles/datatables/datatables.min.js"></script>
  <script src="/admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="/admin/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="/admin/assets/js/page/datatables.js"></script>
  <script src="/admin/assets/bundles/prism/prism.js"></script>



  <!-- JS Libraies -->
  <script src="/admin/assets/bundles/cleave-js/dist/cleave.min.js"></script>
  <script src="/admin/assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="/admin/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="/admin/assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="/admin/assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="/admin/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="/admin/assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="/admin/assets/js/page/forms-advanced-forms.js"></script>
  @yield('js')
  <script>
  var url = window.location.href;
  var a = document.querySelectorAll("[href='"+url+"']")[0];
  a.parentElement.classList.add('active');
  </script>
</body>


<script>
  $(document).ready(function () {
    $('#saveData').on('click', function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('admin.carts.store') }}",
        type: 'POST',
        data: $('#createForm').serialize(),
        success: function (response) {
          console.log(response, 'response')
        },
      });
    });
  });
</script>

<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>