<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="trafficjunky-site-verification" content="8vzopoa00" />
    <meta name="exoclick-site-verification" content="841d0ed3c7bfff56444acc4b31026e80">
    <!-- facbook meta tag -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Website film porn free, film 18+ free, film adult free. All free download full hd" />
    <meta property="og:description" content="Website film porn free, film 18+ free, film adult free. All free download full hd" />
    <meta property="og:site_name" content="Film porn free"/>
    <link rel="alternate" href="http://filmporn.us" hreflang="en-us" />
    
    <title>Film porn</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="{{ asset('js/script.js') }}"></script>
  <script src="{{ asset('node_modules/angular/angular.min.js') }}"></script>
  <script src="{{ asset('js/jquery.cookie.js') }}"></script>
  
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103968058-1', 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript">
  var _prvar=_prvar||new Object();
  (function(pa,s){if(document.getElementById('pr26480560'))return false;
  pa=document.createElement('script');pa.type='text/javascript';pa.async=true;pa.id='pr26480560';pa.src='//prscripts.com/pub.js';
  s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(pa,s);})();
</script>

  </head>
  <body>
<script type="text/javascript" src="https://syndication.exosrv.com/splash.php?idzone=2732964"></script>
 <nav class="navbar navbar-default">
      <div class="container">
      <div class="row">
      <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('/') }}"><span style="color:#de2600">Film</span> <span>porn</span></a>
         
              <div class="free" >@lang('site.100%')</div>
           
            </div>
             
                  <ul class="nav navbar-nav navbar-right">
                 
                      <li class="dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ LaravelLocalization::getCurrentLocaleName() }}  <i class="fa fa-sort-desc" style="margin-left: 10px" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu" role="menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            <span class="language {{$localeCode}}"></span>{{ $properties['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                        </ul>
                      </li>
                </ul>
        </div>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li>
              <a href="{{ url('/') }}">Home</a>
            </li>
             @foreach(App\Categories::all() as $cat)
              <li><a href="{{ url('/category').'/'.$cat->slug }}">{{ $cat->tname }}</a></li>
            @endforeach
          </ul>
   

        </div>
      </div>
    </nav>
   @desktop
    @php
      if (!isset($_COOKIE['18age'])):
  @endphp
           @if(Auth::guest()) 
            <div class="modal age18" data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" id="demo">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                @lang('site.18age')
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-yes" data-dismiss="modal">@lang('site.Yes')</button>
                <a class="btn btn-danger" href="https://www.google.com">@lang('site.No')</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script type="text/javascript">
          $(document).ready(function(){
              // console.log($.cookie("18age"));
              $("#demo").modal("show");
              $('#demo').modal({
                    backdrop: 'static',
                    keyboard: false
              });
              $(".btn-yes").click(function(){
                $.cookie("18age", 1, { expires : 1 });
              });
          });

        </script>
        @endif
        @php
        endif
        @endphp
   
      
@elsedesktop
   
@enddesktop
    <div class="container">
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
      @mobile

      <div class="container">
     <div class="col-md-12 qc" >
<div class="pr-widget" id="pr-o3tx" style="height:100px;width:300px;"></div>
     </div>

   </div>
   @endmobile
      <div class="row">
        <div class="col-md-12">

          <div class="panel panel-default">
            <div class="panel-heading">
              <h2>@yield('title')</h2>
              @yield('title-meta')
            </div>
            <div class="panel-body">

              @yield('content')
            </div>

          </div>
        </div>
      </div>
      <div class=" row">
        <div class="col-md-12 qc">
       @desktop
       <script type="text/javascript">
var ad_idzone = "2728506",
  ad_width = "300",
  ad_height = "250";
</script>
<script type="text/javascript" src="https://ads.exosrv.com/ads.js"></script>
<noscript><a href="https://main.exosrv.com/img-click.php?idzone=2728506" target="_blank"><img src="https://syndication.exosrv.com/ads-iframe-display.php?idzone=2728506&output=img&type=300x250" width="300" height="250"></a></noscript>
<div class="pr-widget" id="pr-o3ko" style="height:250px;width:300px;"></div>
     
     <script type="text/javascript">
var ad_idzone = "2728506",
  ad_width = "300",
  ad_height = "250";
</script>
<script type="text/javascript" src="https://ads.exosrv.com/ads.js"></script>
<noscript><a href="https://main.exosrv.com/img-click.php?idzone=2728506" target="_blank"><img src="https://syndication.exosrv.com/ads-iframe-display.php?idzone=2728506&output=img&type=300x250" width="300" height="250"></a></noscript>
<div class="pr-widget" id="pr-o3ko" style="height:250px;width:300px;"></div>
  @elsedesktop
<div class="pr-widget" id="pr-o3ko" style="height:250px;width:300px;"></div>
 
  @enddesktop
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <div class="footer">
          <p style="text-align: center;color:#fff">
          @lang('site.We hope you enjoyed')<a href="#" target="_self">@lang('site.Think about bookmarking our site!')</a><br>
          @lang("site.If you are not a mature adult or are offended by pornography please don't come back!")
          </p>

          <p>Copyright © 2017 | Film porn</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>                                     
  
  <script type="text/javascript">
  var _prvar=_prvar||new Object();
  (function(pa,s){if(document.getElementById('pr26480560'))return false;
  pa=document.createElement('script');pa.type='text/javascript';pa.async=true;pa.id='pr26480560';pa.src='//prscripts.com/pub.js';
  s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(pa,s);})();
</script>
<sscript type="text/javascript">
  
</script>
  </body>
</html>