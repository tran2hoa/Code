<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{{$title}}</title>
    
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{$title}}">
    <base href="http://ohzui.net/">

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" type="text/css">
    
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" type="text/css">

    <!-- <link rel="stylesheet" href="{{ asset('/css/stylephim.css') }}" type="text/css"> -->

    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}" type="text/css">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </head>
  <body>

      <header class="site-header" role="banner">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="header-logo">
                            <a class="logo" href="{{url('/')}}" title="Xem phim HD">
                              <img src="{{url('/img/logo.png')}}">
                            </a>
                        </div>
                        <div class="search">
                            <form method="GET" id="form-search" action="search/">
                                <input type="text" name="keyword" placeholder="Tìm: tên phim, đạo diễn, diễn viên" value="">
                                <input id="searchsubmit" class="" value=" " type="submit">
                            </form>
                        </div>
                    </div>
                </div> <!--end container -->
            </div> <!--end header -->

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <nav class="navbar navbar-default">
              <div class="container">
                  <div class="row">
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                            @foreach(App\Categories::all() as $cat)
                              <li><a href="{{ url('/category').'/'.$cat->slug }}">{{ $cat->name }}</a></li>
                            @endforeach
                          </ul>
                      </div>
                  </div>
              </div> {{--ennd container--}}
          </nav>

    </header>

  <div id="content" class="site-content">
        <div class="top-section">
                <div class="container">
                  <div class="row">
                      <section>
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
                      </section>
                  </div>
                </div>
        </div>
        <div class="container main-content-area">
              <div id="content" class="site-content">
                        @yield('content')
              </div>
        </div>
  </div>
      <footer>
        <div class="footer">
          <div class="container">
            <div class="row">
              <div class="col-lg-3 footer-logo-film">
                 <a class="logo" href="{{url('/')}}" title="Xem phim HD">
                              <img src="{{url('/img/logo.png')}}">
                            </a>
                <div class="footer-contact">
                    <span>Liên hệ quảng cáo:</span>
                    <p>Email: phim.ohzui.net@gmail.com
                    </p>
                    
                    <p id="client-ipaddress" data-ip="{{Request::ip()}}">
                      IP của bạn: {{Request::ip()}}
                    </p>
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="footer-link">
                  <h3 class="footer-link-head">Phim ohzui.net</h3>
                  <a href="phim-le/" title="Phim lẻ mới">Phim lẻ mới</a>
                  <a href="phim-bo/" title="Phim bộ mới">Phim bộ mới</a>
                  <a href="phim-chieu-rap/" title="Phim chiếu rạp 2013">Phim chiếu rạp</a>
                  <a href="phim-kinh-dien/" title="Phim kinh điển hay">Phim kinh điển</a>
                  <a href="trailer/" title="Trailer phim sắp chiếu">Phim sắp chiếu</a></div>
                  <div class="footer-link">
                    <h3 class="footer-link-head">Phim Lẻ</h3>
                    <a href="the-loai/phim-hanh-dong/">Phim hành động</a>
                    <a href="the-loai/phim-co-trang/">Phim kiếm hiệp</a>
                    <a href="the-loai/phim-kinh-di/">Phim kinh dị</a>
                    <a href="the-loai/phim-vien-tuong/">Phim viễn tưởng</a>
                    <a href="the-loai/phim-hoat-hinh/">Phim hoạt hình</a>
                  </div>
                  <div class="footer-link">
                    <h3 class="footer-link-head">Phim Bộ</h3>
                    <a href="phim-bo/kr/" title="Phim bộ hàn quốc mới">Phim bộ Hàn Quốc</a>
                    <a href="phim-bo/cn/" title="Phim bộ Trung Quốc mới">Phim bộ Trung Quốc</a>
                    <a href="phim-bo/us/" title="Phim bộ của Mỹ mới">Phim bộ Mỹ</a>
                    <a href="phim-bo/vn/" title="Phim bộ Việt Nam mới">Phim bộ Việt Nam</a>
                    <a href="phim-bo/hk/" title="Phim bộ Hồng Kông mới">Phim bộ Hồng Kông</a>
                  </div>
                </div>
                <div class="col-lg-3">
                  
                </div>
              </div>
            </div>
          </div>
      </footer>
    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>