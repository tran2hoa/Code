@extends('layouts.app')
@section('title')
{{$title}}
@endsection

@section('content')
<div class="row">
  <div class="col-md-12" style="border-bottom: 1px solid rgba(0,0,0,.1);margin: 0 0 10px;">
                  <a class="btn-them"  href="{{ url('/links/new') }}">Thêm video <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
  </div>
</div>
@if ( !$posts->count() )
There is no post till now. Login and write a new post now!!!
@else
  @foreach( $posts as $post )
  <div class="list-group">
    <div class="list-group-item row">
          <h3><a href="{{ url('/links/edit/'.$post->slug) }}">{{ $post->title }}</a>
            <a style="float: right" href="{{  url('links/delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
          </h3>
          <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->user_id)}}">{{ $post->author->name }}</a></p>
          
    </div>
  </div>
  @endforeach
  {!! $posts->render() !!}
@endif
@endsection