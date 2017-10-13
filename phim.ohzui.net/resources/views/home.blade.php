@extends('layouts.frontend')
@section('title')
@endsection
@section('content')
@if($posts&&$post)
<div class="main-content-inner">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section class="phim-hot list_carousel">
                    <header>
                        <h2>Phim đáng chú ý</h2>
                    </header>
                    <article>
                        <ul class="movie-carousel-top" >
                            @foreach( $posts as $post )
                                <li>
                                    <a href="{{ url('/'.$post->slug) }}" title="{{$post->title}}">
                                        <div class="item">
                                            <img src="" alt="{{$post->title}}">
                                            <div class="item-meta">
                                                <h3 class="movie-name-1">{{$post->title}}</h3>
                                                <h4 class="movie-name-2">{{$post->title}}</h4>
                                                <!-- <span class="ribbon"></span> -->
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a id="prevTop" class="prev carousel-control" rel="nofollow" style="display: block;">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </a>
                        <a id="nextTop" class="next carousel-control" rel="nofollow" style="display: block;">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </article>
            </section>
            <div class="row">
                <section class="col-md-8 panel-left">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="new-movie">
                                <div class="thumbnail">
                                    <!-- <img src="" alt="{{$post->title}}"> -->
                                </div>
                            </div>

                        </div>
                        <div class="col-md-7">
                               <div class="tabs-movie-block">
                                      <!-- Nav tabs -->
                                      <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#phim-le" aria-controls="home" role="tab" data-toggle="tab">Phim lẻ mới</a>
                                        </li>
                                        <li role="presentation"><a href="#phim-bo" aria-controls="profile" role="tab" data-toggle="tab">Phim bộ mới</a></li>
                                        <li role="presentation"><a href="#phim-bo-full" aria-controls="messages" role="tab" data-toggle="tab">Phim bộ full</a></li>
                                      </ul>

                                      <!-- Tab panes -->
                                      <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="phim-le">
                                            <ul class="list-movie">
                                            @foreach( $posts as $post )
                                                <li class="movie">
                                                    <a class="movie-link" href="{{ url('/'.$post->slug) }}" title="{{$post->title}}">
                                                            <div class="thumbnail">
                                                                <img src="" alt="{{$post->title}}">
                                                            </div>
                                                            <div class="meta">
                                                                    <span class="name-vn link">{{$post->title}}</span>
                                                                    <span class="movie-title-2">{{$post->title}}</span>
                                                            </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="phim-bo">...</div>
                                        <div role="tabpanel" class="tab-pane" id="phim-bo-full">...</div>
                                      </div>

                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <section class="phim-chieu-rap  col-md-12">
                            <header>
                                <h2><span>Phim Chiếu Rạp</span>
                                    <a href="" class="more-list" alt="Phim chiếu rạp mới nhất">Xem tất cả</a>
                                </h2>
                            </header>
                            <article>
                                <div class="list-item">
                                    @foreach( $posts as $post )
                                            <a class="movie-item item col-md-3" href="{{ url('/'.$post->slug) }}" title="{{$post->title}}">
                                                <div class="block-wrapper">
                                                    <div class="thumbnail">
                                                        <img src="" alt="{{$post->title}}">
                                                    </div>
                                                    <div class="movie-meta">
                                                            <div class="movie-title-1">{{$post->title}}</div>
                                                            <span class="movie-title-2">{{$post->title}}</span>
                                                            <!-- <span class="movie-title-chap">125 phút </span> -->
                                                            <!-- <span class="ribbon">HD-Vietsub+Thuyết minh</span> -->
                                                    </div>
                                                </div>
                                            </a>
                                    @endforeach
                                </div>
                            </article>
                        </section>
                    </div>

                     <div class="row">
                        <section class="phim-chieu-rap  col-md-12">
                            <header>
                                <h2><span>Phim Chiếu Rạpa </span>
                                    <a href="" class="more-list" alt="Phim chiếu rạp mới nhất">Xem tất cả</a>
                                </h2>
                            </header>
                            <article>
                                <div class="list-item">
                                    @foreach( $posts as $post )
                                            <a class="movie-item item col-md-3" href="{{ url('/'.$post->slug) }}" title="{{$post->title}}">
                                                <div class="block-wrapper">
                                                    <div class="thumbnail">
                                                        <img src="" alt="{{$post->title}}">
                                                    </div>
                                                    <div class="movie-meta">
                                                            <div class="movie-title-1">{{$post->title}}</div>
                                                            <span class="movie-title-2">{{$post->title}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                    @endforeach
                                </div>
                            </article>
                        </section>
                    </div>

                     <div class="row">
                        <section class="phim-chieu-rap  col-md-12">
                            <header>
                                <h2><span>Phim Chiếu Rạp</span>
                                    <a href="" class="more-list" alt="Phim chiếu rạp mới nhất">Xem tất cả</a>
                                </h2>
                            </header>
                            <article>
                                <div class="list-item">
                                    @foreach( $posts as $post )
                                            <a class="movie-item item col-md-3" href="{{ url('/'.$post->slug) }}" title="{{$post->title}}">
                                                <div class="block-wrapper">
                                                    <div class="thumbnail">
                                                        <img src="" alt="{{$post->title}}">
                                                    </div>
                                                    <div class="movie-meta">
                                                            <div class="movie-title-1">{{$post->title}}</div>
                                                            <span class="movie-title-2">{{$post->title}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                    @endforeach
                                </div>
                            </article>
                        </section>
                    </div>
                </section>
                <aside class="col-md-4 panel-right">
                    <div class="right-box " id="bookmark-box" style="display: block;">
                        <h2 class="right-box-header star-icon">
                            <span>Phim đã đánh dấu</span>
                        </h2>
                        <a  href="" rel="nofollow" class="right-box-content btn-load" id="bookmark-btn-load">
                            <span class="bookmark-text" id="bookmark-text">Phim đã đánh dấu</span>
                            <span class="bookmark-count" id="bookmark-count">(0)</span>
                            <span class="status-icon normal"></span>
                        </a>
                        <div class="right-box-content" id="bookmark-list-box" style="display: none"></div>
                    </div>
                </aside>

            </div>
            

        </main>
    </div>
</div>
@endif
<script src="{{asset('/js/jquery.carouFredSel-6.2.1.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.movie-carousel-top').carouFredSel({
            auto: false,
            prev: '#prevTop',
            next: '#nextTop',
        });
        $('.movie-carousel-rap').carouFredSel({
            auto: false,
            prev: '#prevCR',
            next: '#nextCR',
        });
    });
</script>
@endsection