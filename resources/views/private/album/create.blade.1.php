@extends('private.layouts.app')

@section('content')
<div class="row">
        <div class="col-md-8" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Create Album</h4>
              <p class="card-category">Add Album to your site.</p>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('albums.store') }}" enctype="multipart/form-data">
                            @csrf
       
     
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
                        <label class="bmd-label-floating">Feature Image</label>
                       
                        <div class="input-group">
                          <input type="text" class="form-control" name="firstname">
                          <span class="input-group-btn"> 
                          <label class="btn btn-primary" type="submit" ><i class="fa fa-folder-open-o"></i> Choose<input id="imgInp"  type="file" name="image" style="display:none;"></label></span>
                  </div> 
                      </div>
                          <img height="100px" width="120px" id="image" class="img" src="{{asset('material/assets/img/album.png')}}">
                          <a href="#" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="material-icons">close</i>
                          </a>
                    </div>
              </div>

              <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Description</label>
                        <input type="text" class="form-control" name="description">
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

          
             
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
    
      </div>
@endsection