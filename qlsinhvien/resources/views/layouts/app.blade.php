
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Trang quản lý</title>
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- javascript -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="{{ asset('node_modules/angular/angular.min.js') }}"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-touch.js"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-animate.js"></script>
   <script src="http://ui-grid.info/docs/grunt-scripts/csv.js"></script>
   <script src="http://ui-grid.info/docs/grunt-scripts/pdfmake.js"></script>
   <script src="http://ui-grid.info/docs/grunt-scripts/vfs_fonts.js"></script>
   <script src="{{asset('node_modules/angular-ui-grid/ui-grid.min.js') }}"></script>
   <link rel="stylesheet" href="{{asset('node_modules/angular-ui-grid/ui-grid.min.css') }}">
   <script src="{{asset('app/app.js') }}"></script>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body  class="admin">
    <div id="sidebar" class="navbar-collapse">
        <ul class="sidebar-menu" id="nav-accordion">
              <li>
               <a href="{{ url('/admin') }}">
                   <i class="fa fa-tachometer fa-2x" aria-hidden="true"></i>
                   <span>Dashboard</span>
               </a>
              </li>
              <li>
                 <a href="{{ url('/admin/exam') }}">
                     <i class="fa fa-calendar fa-2x" aria-hidden="true"></i>
                     <span>Kỳ thi</span>
                 </a>
              </li>
              <li>
                 <a href="{{ url('/admin/course') }}">
                     <i class="fa fa-book fa-2x" aria-hidden="true"></i>
                     <span>Khoá học</span>
                 </a>
              </li>
              <li>
                 <a href="{{ url('/admin/room') }}">
                     <i class="fa fa-building-o fa-2x" aria-hidden="true"></i>
                     <span>Phòng</span>
                 </a>
              </li>
              <li>
                 <a href="{{ url('/admin/user') }}">
                     <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
                     <span>Học viên</span>
                 </a>
              </li>
              <li>
                  <a href="{{ url('/logout') }}"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                      <span>Đăng xuất</span>
                  </a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </li>
          </ul>
    </div>
    <section id="main-content">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li>
                <div class="panel-heading">
                    <h2>@yield('title')</h2>
                </div>
            </li>
          </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ url('/admin') }}"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a>
                    </li>
                  <li>
                    <a href="{{ url('/admin/videos/create') }}">Add Video</a>
                  </li>
                   <li>
                    <a href="{{ url('/categories') }}">Category</a>
                  </li>
                  <li>
                    <a href="{{ url('/auth/logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
              </li>
            </ul>
        </div>
      </div>
    </nav>
      @if (Session::has('message'))
      <div class="flash alert-info">
        <p class="panel-body">
          {{ Session::get('message') }}
        </p>
      </div>
      @endif
      @if ($errors->any())
      <div class='flash alert-danger'>
        <ul class="panel-body">
          @foreach ( $errors->all() as $error )
          <li>
            {{ $error }}
          </li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="col-md-12">
      <div class="row">
          <div class="panel panel-default">

            <div class="panel-body">
              @yield('content')
            </div>
          </div>
      </div>
      </div>

    </section>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
     @yield('footer_script')
    </body>
</html>
