<!-- return from Admin\CategoryController@index -->
{{--views\categories\home.blade.php--}}
@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector : "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | media",

        });
    </script>
    <div class="row">
      <div class="col-md-12" style="border-bottom: 1px solid rgba(0,0,0,.1);margin: 0 0 10px;">
                      <a class="btn-them"  data-toggle="modal" data-target="#add-category" >Add category <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
      </div>
    </div>
    @if ( !$posts->count() )
    There is no category till now.
    @else
      @foreach( $posts as $post )
      <div class="list-group">
        <div class="list-group-item row">
              <h3>
                  <a href="{{ url('/admin/categories/'.$post->id.'/edit/') }}">{{ $post->name }}</a>
                <a style="float: right" href="{{  url('admin/categories/delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
              </h3>

        </div>
      </div>
      @endforeach
      {!! $posts->render() !!}
    @endif

    <div id="add-category" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Category</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12" >
                            <form action="{{url('/admin/categories/')}}" method="post">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <input required="required" value="{{ old('name') }}" placeholder="Enter name category" type="text" name="name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <textarea name='description' class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <input type="submit" name='publish' class="btn btn-success" value = "Add"/>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection