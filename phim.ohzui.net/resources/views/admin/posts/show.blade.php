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
            <div class="block-wrapper page-single">
                    <div class="movie-info">
                        <div class="col-md-6 movie-title">
                            <img src="" alt="{{$post->title}}">
                            <ul class="btn-block">
                                <li class="item">
                                    <a id="btn-film-download" class="btn btn-green btn" title="Download phim {{$post->titile}}" href="">Download</a>
                                </li>
                                <li class="item">
                                    <a id="btn-film-trailer" class="btn btn-primary btn-film-trailer" title="Trailer {{$post->titile}}" href="">Trailer</a>
                                </li>
                                <li class="item">
                                    <a id="btn-film-watch" class="btn btn-red" title="Xem phim {{$post->titile}}" href="">Xem phim</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 movie-detail">
                            <h1 class="movie-title">
                                <span class="title-1">
                                    <a class="title-1" href="">{{$post->title}}</a>
                                </span>
                               <!--  <span class="title-2">A Gift</span>
                                <span class="title-year"> (2017)</span> -->
                            </h1>
                            <div class="info-box">
                                
                            </div>
                            <div class="info-box">
                               <p>Đánh giá phim <span></span></p>
                            </div>

                    </div>
                    <div class="clear"></div>
            </div>
        </section>
        <aside class="col-md-4">
            <div class="right-box " id="bookmark-box" style="display: block;">
                <h2 class="right-box-header star-icon"><span>Phim đã đánh dấu</span></h2><a href="javascript:void(0)" rel="nofollow" class="right-box-content btn-load" id="bookmark-btn-load"><span class="bookmark-text" id="bookmark-text">Phim đã đánh dấu</span><span class="bookmark-count" id="bookmark-count">0</span><span class="status-icon normal"></span></a><div class="right-box-content" id="bookmark-list-box" style="display: none"></div></div>
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