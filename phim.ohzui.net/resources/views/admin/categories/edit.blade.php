@extends('layouts.app')
@section('title')
Edit Category
@endsection
@section('content')
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
    });
</script>
<div class="row">
    <div class="col-md-5" >
         <form action="/edit-category" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="category_id" value="{{ $post->id }}{{ old('post_id') }}">
            <div class="form-group">
              <input required="required" value="@if(!old('name')){{$post->name}}@endif{{ old('name') }}" placeholder="Enter name category" type="text" name="name" class="form-control" />
            </div>
            <div class="form-group">
              <textarea name='description' class="form-control">
                 @if(!old('description'))
                        {!! $post->description !!}
                        @endif
                        {!! old('description') !!}
              </textarea>
            </div>
            
            <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
        </form>
    </div>
    <div class="col-md-7" >
            <div class="postbox">
                 <h3>Languages</h3>
                 <div class="">
                     <ul class="nav nav-tabs">
                     @php $i=0; @endphp
                       @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if(in_array($localeCode, $langs))
                                <li class='@php if($i==0) echo "active";$i++; @endphp'>
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
                               @php $i=0; @endphp
                             @foreach($post->translations as $lang)
                                  <div id="{{$lang->locale}}" class="tab-pane fade @php if($i==0) echo 'in active';$i++; @endphp">
                                    <form action="/languages" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="category_id" value="{{ $post->id }}{{ old('post_id') }}">
                                        <div class="form-group">
                                          <input required="required" value="{{$lang->tname}}" placeholder="Enter name {{$lang->locale}}" type="text" name="name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                          <textarea name='description' class="form-control">
                                            {{$lang->tdescription}}
                                          </textarea>
                                        </div>
                                        
                                        <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
                                    </form>
                                  </div>
                                  @endforeach
                        </div>

                 </div>
            </div>
    </div>
 
</div>
<div id="add-language" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add language</h4>
      </div>
      <div class="modal-body">
            <form action="/languages" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="category_id" value="{{ $post->id }}{{ old('post_id') }}">
                    <div class="form-group">
                    <select class="form-control" name="locale">
                     @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if(!in_array($localeCode, $langs))
                         <option value="{{ $localeCode }}">{{ $properties['name'] }}</option>
                    @endif
                    @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                      <input required="required" value="" placeholder="Enter name category" type="text" name="name" class="form-control" />
                    </div>
                    <div class="form-group">
                      <textarea name='description' class="form-control">
                       
                      </textarea>
                    </div>
                    
                    <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
      </div>
     
    </div>

  </div>
</div>
@endsection