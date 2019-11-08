@extends('private.layouts.app')

@section('content')
<div class="row">
        <div class="col-md-12" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Create Album</h4>
              <p class="card-category">Add Album to your site.</p>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('albums.update',[$album->id]) }}" enctype="multipart/form-data">
                           @csrf
       
                           <div class="row">
                            <div class="col-md-8">


                           <div class="panel">
                      
                             <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Name</label>
                                      <input type="text" class="form-control" name="name" value="{{$album->name}}">
                                      </div>
                                    </div>
                                  </div>
                             </div>
                           </div>

                              <div class="row">
                                <div class="col-md-12">
                                    <div class="gallery">
                                           <div class="gallery-body">
                                              <label class="btn btn-primary"> add Images<input id="imgInp"  type="file" name="multi_upload[]" style="display:none;" multiple/></label>
                                            <div class="gallery-grid">
                                             
                                            </div>  
                                          </div>
                                    </div>
                                   
                                </div>
                             </div>


                            </div>

                            
                            <div class="col-md-4">
                              <div class="panel">
                                <div class="panel-header">
                                    <label class="bmd-label-floating">Category</label>  
                                                
                                </div>

                                <div class="panel-body">
                                              
                                          <select name="category" class ="form-control">
                                          <option value="{{$album->category_id}}">{{$album->category->name}}</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                               
                                           </select>
                              
                                   </div>   
                                
                               
                             </div>
                             <div class="panel">
                                <div class="panel-header">
                                    <label class="bmd-label-floating">Tags</label>  
                                                    
                                </div>
                               <div class="panel-body">
                                  <div class="row">
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Separate tags with commas</label>
                                        <input type="text" class="form-control" name="tags" value="{{$album->tags}}">
                                          
                                        </div>
                                     </div>
                                     
                                   
                               </div>   
                               </div>
                             </div>

                             <div class="panel">
                                <div class="panel-header">
                                    <label class="bmd-label-floating">Feature Image</label>                                
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <label class="custom-link">Set feature image<input id="feature-image"  type="file" name="image" style="display:none;"></label>
                                         
                                       </div>
                                       <div class="col-md-12">

                                        @if ($album->featured_image == null)
                                          <img height="200px" width="275px" id="image" class="img" src="{{asset('material/assets/img/album.png')}}">
                                          <a href="#" class="text-danger remove-feature-image">Remove Image</a>
                                        @else
                                        <img height="200px" width="275px" id="image" class="img" src="{{asset('material/album/'.$album->slug .'/'.$album->featured_image)}}">
                                        <a href="#" class="text-danger remove-feature-image">Remove Image</a>
                                        @endif
                                         
                                       </div>
                                   </div>  
                                </div>
                               
                             </div>

                             <div class="panel">
                                <div class="panel-header">
                                
                                    <h4 class="card-title">Publish</h4>
                                  
                                </div>
                                <div class="panel-body">
                                    <select class ="form-control" name="status">

                                        <option value="0">Unpublish</option>
                                        <option value="1">Publish</option>
                                       
                                                                          
                                    </select>
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                    <div class="clearfix"></div>
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