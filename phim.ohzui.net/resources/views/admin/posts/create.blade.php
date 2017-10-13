@extends('layouts.app')
@section('title')
Add New Videos
@endsection
@section('content')
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
  tinymce.init({
        selector : "textarea.tinymce",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | media",
        
    });
  tinymce.init({
        selector : "textarea.description",
        menubar:false,
        statusbar: false,
        plugins : ["advlist autolink lists link charmap print preview ", "searchreplace  code", "insertdatetime table contextmenu paste jbimages"],
         toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ",
        
    });
</script>
    <form action="{{asset('/admin/videos')}}" method="post">
         <div class="row" >
            <div class="col-md-8" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <input required="required" ng-model="post.title" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title" class="form-control" />
                      </div>
                       <div class="form-group">
                          <textarea name='description' placeholder="description" value="" class="form-control description">
                           Description
                          </textarea>
                      </div>
                      <div class="form-group">
                        <textarea name='body' class="form-control tinymce" >@if(!old('body')) Body @endif{{ old('body') }}</textarea>
                      </div>
                      
                  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
                  <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />
            </div>
            <div class="col-md-4" >
              <div id="category" class="postbox">
                  <h3>Categories <a class="btn-them"  data-toggle="modal" data-target="#add-category" ><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                  </h3>
                  <div class="row">
                      <div class="col-md-12">
                      <ul id="categorychecklist">
                          @foreach($categories as $cat)
                            <li style="list-style: none">
                            <input type="checkbox" name="category[]" value="{{$cat->id}}" />
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
                             <img alt="Click to change thumbnail" />    
                             <div class="thumbnail-hover"></div>   
                    </div>
                    <div  class="upload-image" >Set featured image</div>
                    <input type="hidden" name="thumbnail">
              </div>
               <div id="video" class="postbox">
                  <h3>Video source</h3>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <input ng-model="post.video" value="{{ old('video') }}" placeholder="Enter source video" type="text" name = "video" class="form-control" />
                        </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
      </form>

{{--form upload image--}}
<form style="display: none;" id="upload-image" method="post" enctype="multipart/form-data" action="/upload-image">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row input-file">
            <div class="col-md-12 form-group">
                <input type="file"  name="image" class="upload" style="position:fixed;top:0;left:0;opacity: 0;width: 0;height: 0"/>
                
            </div>
        </div>
    </form>

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
          $('textarea').focus(function(){
            $(this).select();
          });
          $('.upload-image').click(function(){
                $("input.upload").click();
          });
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
                      console.log(data);
                      $(".image-upload").show();
                      $(".image-upload>img")[0].src =data;
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