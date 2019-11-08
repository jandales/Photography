@extends('private.layouts.app')

@section('content')
<div class="row">
        <div class="col-md-12" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Create Post</h4>
              <p class="card-category">Add Post to your site.</p>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                           @csrf
                        <div style="margin:0 auto;" class="col-md-11">
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Name</label>
                                  <input type="text" class="form-control" name="title">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Content</label>                                     
                                      <textarea rows="20" class="texteditor" name="content">      
                                      </textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="bmd-label-floating">Category</label>
                                          <select name="category" class ="form-control">
                                              @foreach ($categories as $category)
                                              <option value="{{$category->id}}">{{$category->name}}</option>
                                              @endforeach                                             
                                          </select>
                                        </div>
                                      </div>
                                </div>

                                
                             <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="bmd-label-floating">Tags</label>
                                    <input type="text" class="form-control" name="tags">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                       
                                  <div class="col-md-12">
                    
                                      <label class="custom-link btn btn-primary" >Set feature image<input id="feature-image"  type="file" name="image" style="display:none;"></label>
                    
                                    <div class="feature-image-container">
                                        <img  id="image" class="featured-image" src="{{asset('material/assets/img/album.png')}}">
                                    
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
                                      <option value="0">Draft</option> 
                                      <option value="1">Unpublished</option>
                                      <option value="2">Published</option>                                                                           
                                    </select>
                                  </div>
                                </div>
                           </div>
                           <button type="submit" class="btn btn-primary pull-right">Create</button>
                           <div class="clearfix"></div>
               
                  
                        </div>

                          
            </form>
            </div>
          </div>
        </div>
    
      </div>
@endsection