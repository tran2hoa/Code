@extends('layouts.frontend')
@section('title')

@endsection
@section('title-meta')
@endsection
@section('content')
    <ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemprop="item" title="Phim Mới" href="./"><span itemprop="name">Phim Mới</span></a></li><li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" title="Phim lẻ" href="phim-le/"><span itemprop="name">Phim lẻ</span></a></li><li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" title="Phim hài hước" href="the-loai/phim-hai-huoc/"><span itemprop="name">Phim hài hước</span></a></li><li class="active">Món Quà Tình Yêu
        </li>
    </ol>
    <div class="row">
        <section class="col-md-8">
            <article class="block-wrapper page-single">
                    @if($post)
                        @if ($post->video)
                            <?php
                            function curl($url) {
                                $ch = @curl_init();
                                curl_setopt($ch, CURLOPT_URL, $url);
                                $head[] = "Connection: keep-alive";
                                $head[] = "Keep-Alive: 300";
                                $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
                                $head[] = "Accept-Language: en-us,en;q=0.5";
                                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                                curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
                                $page = curl_exec($ch);
                                curl_close($ch);
                                return $page;
                            }
                            function getPhotoGoogle($link){
                                $get = curl($link);
                                $data = explode('url\u003d', $get);
                                $url = explode('%3Dm', $data[1]);
                                $decode = urldecode($url[0]);
                                $count = count($data);
                                $linkDownload = array();
                                if($count > 4) {
                                    $v1080p = $decode.'=m37';
                                    $v720p = $decode.'=m22';
                                    $v360p = $decode.'=m18';
                                    $linkDownload['1080p'] = $v1080p;
                                    $linkDownload['720p'] = $v720p;
                                    $linkDownload['360p'] = $v360p;
                                }
                                if($count > 3) {
                                    $v720p = $decode.'=m22';
                                    $v360p = $decode.'=m18';
                                    $linkDownload['720p'] = $v720p;
                                    $linkDownload['360p'] = $v360p;
                                }
                                if($count > 2) {
                                    $v360p = $decode.'=m18';
                                    $linkDownload['360p'] = $v360p;
                                }
                                return $linkDownload;
                            }
                            $link = $post->video;
                            try{
                                $test = getPhotoGoogle($link);
                                if($test['360p']){
                                    $string_vi = '<video id="filmporn" width="720" height="auto" controls poster="http://phim.ohzui.net/images/poster.png"><source src="'.$test['360p'].'" type="video/mp4"></video>';
                                }
                                elseif($test['720p']){
                                    $string_vi = '<video id="filmporn"  width="720" height="auto" controls poster="http://phim.ohzui.net/images/poster.png"><source src="'.$test['720p'].'" type="video/mp4"></video>';
                                }
                                else{
                                    $string_vi="No video";
                                }
                            }
                            catch(Exception $e){
                                $string_vi = '<video id="filmporn" width="720" height="auto" poster="http://phim.ohzui.net/images/poster.png" controls><source src="" type="video/mp4" /> <p>Your browser does not support the video tag.</p></video>';
                                // echo 'Caught exception: ',  $e->getMessage(), "\n";
                            }

                            ?>
                            <div style="text-align:center;" class="videoContainer">
                                <!-- <span class="play" controls preload="auto" onclick="playPause()"><i class="fa fa-play" aria-hidden="true"></i></span> -->
                                <?php echo $string_vi; ?>
                                <div class="control">
                                    <div class="topControl">
                                        <div class="btnPlay btn" title="Play/Pause video"></div>
                                        <div class="btnStop btn" title="Stop video"></div>
                                        <div class="progress">
                                            <span class="bufferBar"></span>
                                            <span class="timeBar"></span>
                                        </div>
                                        <div class="time">
                                            <span class="current"></span> /
                                            <span class="duration"></span>
                                        </div>
                                        <div class="sound sound2 btn" title="Mute/Unmute sound">
                                            <div class="volume" title="Set volume">
                                                <span class="volumeBar"></span>
                                            </div>
                                        </div>
                                        <div class="btnFS btn" title="Switch to full screen"></div>

                                    </div>



                                </div>
                                <div class="loading"></div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                {!! $post->views !!} @lang('site.views')
                            </div>
                        </div>
                        {!! $post->tbody !!}


                    @else
                        404 error
                    @endif
            </article>
        </section>
        <aside class="col-md-4">
            test
        </aside>

    </div>

    <section class="phim-chieu-rap list_carousel">
        <article>
            <header>
                <h2>Phim Chiếu Rạp</h2>
            </header>
            <ul class="movie-carousel-random" id="carousel" >
                @foreach( $ran_posts as $post )
                    <li>
                        <a href="{{ url('/'.$post->slug) }}" title="{{$post->title}}">
                            <div class="item">
                                <img src="" alt="{{$post->title}}">
                                <div class="movie-carousel-item-meta">
                                    <h3 class="movie-name-1">{{$post->title}}</h3>
                                    <h4 class="movie-name-2">{{$post->tttle}}</h4>
                                    <span class="ribbon">Tập 4/20</span>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <a id="prev" class="prev" rel="nofollow" style="display: block;"><span class="arrow-icon left"></span></a>
            <a id="next" class="next" rel="nofollow" style="display: block;"><span class="arrow-icon right"></span></a>
        </article>
    </section>
    <script src="{{ asset('js/video.js') }}"></script>
    <script src="{{asset('/js/jquery.carouFredSel-6.2.1.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.movie-carousel-random').carouFredSel({
                auto: false,
                prev: '#prevTop',
                next: '#nextTop',
            });

        });
    </script>
@endsection