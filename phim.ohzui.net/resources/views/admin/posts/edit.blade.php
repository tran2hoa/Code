@extends('layouts.app')
@section('title')
Edit Post
@endsection
@section('content')
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
        selector : "textarea.tinymce",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
    });
tinymce.init({
        selector : "textarea.description",
        menubar:false,
        statusbar: false,
        plugins : ["advlist autolink lists link charmap print preview ", "searchreplace  code", "insertdatetime table contextmenu paste jbimages"],
         toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ",
        
    });
</script>
<ul class="nav nav-tabs">
    <li class='active'>
                  <a data-toggle="tab" rel="alternate" href="#default">
                  default
                  </a>
        </li>
@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
  @if(in_array($localeCode, $langs))
      <li>
          <a data-toggle="tab" rel="alternate" hreflang="{{ $localeCode }}" href="#{{  $localeCode  }}">
              {{ $properties['name'] }}
          </a>
      </li>
  @endif
@endforeach
  <li>
      <a  data-toggle="modal" data-target="#add-language">
             <i class="fa fa-plus" aria-hidden="true"></i>
          </a>
  </li>
</ul>
<div class="tab-content">
      <div id="default" class="tab-pane fade active in">
          <form id="form-edit" method="POST" action='{{ url("/admin/videos/".$post->id) }}'>
              <div class="row" >
                      <div class="col-md-9" >
                            <input type="hidden" name="_method" value="PUT">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
                              <div class="form-group">
                                <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
                              </div>
                              <div class="form-group">
                                <textarea name='description' class="form-control description">
                                  @if(!old('description'))
                                  {!! $post->description !!}
                                  @endif
                                  {!! old('description') !!}
                                </textarea>
                              </div>
                              <div class="form-group">
                                <textarea name='body' class="form-control tinymce">
                                  @if(!old('body'))
                                  {!! $post->body !!}
                                  @endif
                                  {!! old('body') !!}
                                </textarea>
                              </div>
                              <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
                              <a href="{{  url('admin/videos/delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
                      </div>
                      <div class="col-md-3" >
                      <div id="category" class="postbox">
                          <h3>
                              Categories
                              <a class="btn-them"  data-toggle="modal" data-target="#add-category" >
                                  <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                          </h3>
                              <div class="row">
                                <div class="col-md-12">
                                    <ul id="categorychecklist">
                                        @foreach($categories as $cat)
                                            <li style="list-style: none">
                                                <input @if(in_array($cat->name, $inCats)) checked @endif type="checkbox" name="category[]" value="{{$cat->id}}" />
                                                {{$cat->name}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                         <div id="thumbnail" class="postbox" >
                              <h3>Featured Image</h3>
                              <div class="image-upload">
                                       <img src="@if(!old('thumbnail')){{url($post->thumbnail)}}@endif{{ old('thumbnail') }}" alt="Click to change thumbnail" />    
                                       <div class="thumbnail-hover"></div>   
                              </div>
                              <div  class="upload-image" >Set featured image</div>
                              <input type="hidden" name="thumbnail" ng-model="hoso.thumbnail" value="@if(!old('thumbnail')){{$post->thumbnail}}@endif{{ old('thumbnail') }}" />
                        </div>
                         <div id="video" class="postbox">
                            <h3>Video source</h3>
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <input  value="@if(!old('video')){{$post->video}}@endif{{ old('video') }}" type="text" name = "video" class="form-control" />
                                  </div>
                                </div>
                            </div>
                        </div>
                      
                      </div>
                </div>
          </form>
      </div>
   @foreach($post->translations as $lang)
        <div id="{{$lang->locale}}" class="tab-pane fade">
          <form action="{{asset('/admin/videos/languages/edit')}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="post_id" value="{{ $post->id }}">
              <input type="hidden" name="locale" value="{{ $lang->locale }}">

              <div class="form-group">
                <input required="required" value="{{$lang->ttitle}}" placeholder="Enter name {{$lang->locale}}" type="text" name="title" class="form-control" />
              </div>
              <div class="form-group">
                <textarea name='description' class="form-control tinymce">
                  {{$lang->tdescription}}
                </textarea>
              </div>
              <div class="form-group">
                <textarea name='body' class="form-control tinymce">
                  {{$lang->tbody}}
                </textarea>
              </div>
              <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
          </form>
        </div>
        @endforeach
</div> <!-- end tab-content -->

<form style="display: none;" id="upload-image" method="post" enctype="multipart/form-data" action="/upload-image">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row input-file">
            <div class="col-md-12 form-group">
                <input type="file"  name="image" class="upload" style="position:fixed;top:0;left:0;opacity: 0;width: 0;height: 0"/>
                
            </div>
        </div>
    </form>

<!-- modal them languages -->
<div id="add-language" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add language</h4>
      </div>
      <div class="modal-body">
            <form action="{{url('/admin/videos/languages')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                          
                    <div class="form-group">
                    <select class="form-control" name="locale">
                     @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if(!in_array($localeCode, $langs))
                         <option @if($localeCode=="en") selected @endif value="{{ $localeCode }}">{{ $properties['name'] }}</option>
                    @endif
                    @endforeach
                    </select>
                    </div>
                  <div class="form-group">
                            <input required="required" value="{{$post->title}}" placeholder="Enter title video for new language" type="text" name="title" class="form-control" />
                          </div>
                          <div class="form-group">
                            <textarea name='description' class="form-control tinymce">
                              {{$post->description}}
                            </textarea>
                          </div>
                          <div class="form-group">
                            <textarea name='body' class="form-control tinymce">
                            {{$post->body}}
                            </textarea>
                          </div>
                    
                    <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
      </div>
     
    </div>

  </div>
</div>

{{--modal add new cateogry--}}
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

<script type="text/javascript">
  $("input[type='text']").click(function () {
   $(this).select();
});
</script>

<script type="text/javascript">
    $('.upload-image').click(function(){
          $("input.upload").click();
    });
    var baseUrl = document.location.origin;
     $('input.upload').change(function(){
        $(".image-upload img")[0].src = window.URL.createObjectURL(this.files[0]);
        $(".image-upload").show().css({'opacity':'0.5'});
        var formupload=$("#upload-image");
        var url=formupload.attr("action");
         $.ajax({
            url: url,
            type: formupload.attr("method"),
            dataType: "JSON",
            data: new FormData(formupload[0]),
            processData: false,
            contentType: false,
            success: function (data, status)
            {
                $(".image-upload").show();
                $(".image-upload>img")[0].src =baseUrl+"/"+data;
                $('.input-file').hide();
                $(".image-upload").css('opacity','1');
                $("#thumbnail input[name='thumbnail']").val(data);
            },
            error: function (xhr, desc, err)
            {
            }
        });   
        
    });


</script>
@endsection