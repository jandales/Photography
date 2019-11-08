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
            <form method="POST" action="{{ route('albums.store') }}" enctype="multipart/form-data">
                           @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="bmd-label-floating">Name</label>
                                    <input type="text" class="form-control" name="name">
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
                                  <option value="0">Unpublish</option>
                                  <option value="1">Publish</option>
                                   
                                </select>
                              </div>
                            </div>
                       </div>
                      
                         
                            <button type="submit" class="btn btn-primary pull-right">Create</button>
                            <div class="clearfix"></div>
                
                          </div>
                        </div>
                  </div><!-- end col-md-5-->
                  <div class="col-md-7">
                      <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="btn btn-primary"> add Images<input id="ImageUploader"  type="file" name="multi_upload[]" style="display:none;" multiple/></label>
                            </div>
                          </div>
                        </div>

                        <table class="table table-reponsive">
                  
                            <tbody id="tbody">                          

                            
                            </tbody>
                          </table>
                    
                  </div>
                </div>

                          
            </form>
            </div>
          </div>
        </div>
    
      </div>
@endsection