
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

       <title>Panel film</title>
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style_admin.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="{{ asset('js/script.js') }}"></script>
{{--  <script src="{{ asset('node_modules/angular/angular.min.js') }}"></script>--}}
  <script src="{{ asset('js/jquery.cookie.js') }}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body  class="admin">
    <aside>
    <div id="sidebar" class="navbar-collapse">
      <ul class="sidebar-menu" id="nav-accordion">

      @if(!Auth::guest())
                <li>
                       <a href="{{ url('/admin') }}"><i class="fa fa-tachometer fa-2x" aria-hidden="true"></i><span>Dashboard</span></a>

                </li>
              <li>
                  <a href="{{ url('/') }}">
                      <i class="fa fa-home fa-2x"></i>
                      <span>Site Home</span>
                  </a>
              </li>
                <li>
                   <a href="{{ url('/admin/videos') }}"><i class="fa fa-video-camera fa-2x" aria-hidden="true"></i><span>Videos</span></a>
                </li>

                <li>
                    <a href="{{ url('/admin/categories') }}"><i class="fa fa-clone fa-2x" aria-hidden="true"></i><span>Category</span></a>
                </li>
                <li>
                    <a href="{{ url('/user/'.Auth::id()) }}"><i class="fa fa-cogs fa-2x"></i><span>My Profile</span></a>
                </li>
                <li>
                <a href="{{ url('/logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                                      <span>Logout</span>
                                  </a>

                                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                </li>
        @endif
        </ul>
    </div>
    </aside>
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
