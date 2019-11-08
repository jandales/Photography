@extends('private.layouts.app')

@section('content')
<div class="row">
        <div class="col-md-12" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Edit Album</h4>

            </div>
            <div class="card-body">
            <form  id="form" method="POST" action="{{ route('albums.update',[$album->id]) }}" enctype="multipart/form-data">
              {{-- <form id="formn" method="POST" action="#" enctype="multipart/form-data"> --}}
                           @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$album->name}}">
                                    </div>
                                  </div>
                                </div>
                
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Category</label>
                                      <select name="category" class ="form-control">

                                         <option value="{{$album->category_id}}">{{$album->category->name}}</option>
                                          @foreach ($categories as $category)
                                              @if($album->category_id != $category->id)
                                                <option value="{{$category->id}}">{{$category->name}}</option>                                                                                           
                                              @endif                                        
                                          @endforeach
                                         
                                      </select>
                                    </div>
                                  </div>
                             </div>
                
                             <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Tags</label>
                                <input type="text" class="form-control" name="tags" value="{{$album->tags}}">
                                </div>
                              </div>
                            </div>
                
                            <div class="row">
                       
                              <div class="col-md-12">
                
                                  <label class="custom-link btn btn-primary" >Set feature image<input id="feature-image"  type="file" name="image" style="display:none;"></label>
                
                                <div class="feature-image-container">

                                  @if ($album->featured_image != null)
                                  <img  id="image" class="featured-image visible" src="{{asset($album->featured_image)}}">
                                  @else
                                  <img  id="image" class="featured-image" src="{{asset('material/assets/img/album.png')}}">
                                  @endif                                 
                                  
                                <a href="#" id="remove-feature-image" rel="tooltip" title="Remove image" class="btn btn-danger btn-link btn-sm image-delete">
                                   <i class="material-icons">close</i>
                                </a>
                                </div>
                
                                 
                              </div>
                          </div>  
                
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="bmd-label-floating">Status</label>
                                <select  class ="form-control" name="status">

                                  @if ($album->published)                                    
                                    <option value="1">Published</option>
                                    <option value="0">Unpublish</option> 
                                  @else
                                   <option value="0">Unpublish</option>
                                    <option value="1">Publish</option>
                                  @endif
                                 
                                   
                                </select>
                              </div>
                            </div>
                       </div>
                      
                         
                            <button type="submit" id="submit" class="btn btn-primary pull-right">Submit</button>
                            <div class="clearfix"></div>
                
                          </div>
                        </div>
                  </div><!-- end col-md-5-->
                  <div class="col-md-7">
                      <div class="row">

                  
<div class="col-md-12">	
<ul  class="nav nav-pills">
			<li>
        <a  href="#1b" class="active" role="" data-toggle="tab">Media</a>
			</li>
			<li><a href="#2b" data-toggle="tab">Upload Images</a>
			</li>
		
		</ul>

			<div class="tab-content clearfix">
          <div class="tab-pane active" id="1b">

              <div class="tab-header">
                  <h4 class="h4-header">Photos({{$album->photos()->count()}})</h4>
                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                      <div class="btn-group mr-2" role="group" aria-label="First group">
                
                      <button id="image-select-all" type="button" class="btn btn-primary">Select all</button>
                      <button id="album-delete-photos" type="button" class="btn btn-primary">Delete</button>
                    </div>
                                       
                  </div>
                </div>
            <div class="media">
                
                @foreach ($photos as $image)
                  <div class="media-item">
                    <img   src="{{asset($image->location)}}"/>
                    <div class="form-check hidden">
                        <label class="form-check-label">
                          <input name="checkbox" id="{{$image->id}}" class="form-check-input" type="checkbox" value="">
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                        </label>
                    </div>
                    <a href="#" id="{{$image->id}}" rel="tooltip" title="Remove image" class="btn btn-danger btn-link btn-sm image-delete delete-photos">
                        <i class="material-icons">close</i>                    
                    </a>
                  </div>
                @endforeach
               
               
            </div>

           <div style="margin:20px;">
              {{$photos->links()}}
           </div>

          </div>

          <!-- addding new photos -->
          <div class="tab-pane" id="2b">

                <div class="col-md-12">
                    <div class="form-group">
                      <label class="btn btn-primary"> add Images<input id="ImageUploader"  type="file" name="multi_upload[]" style="display:none;" multiple/></label>
                    </div>
                </div>          

                <table class="table table-reponsive">
                  <tbody id="tbody">                          
                
                  </tbody>
                </table>
          
          </div>    
          <!-- / addding new photos --> 
        
			</div>
  </div>
                   
                  </div>
                </div>

                          
            </form>
            </div>
          </div>
        </div>
    
      </div>
@endsection