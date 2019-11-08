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
                            <div class="col-md-8">


                           <div class="panel">
                      
                             <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Name</label>
                                      <input type="text" class="form-control" name="name">
                                      </div>
                                    </div>
                                  </div>
                             </div>
                           </div>

                              <div class="row">
                                <div class="col-md-12">
                                    <div class="gallery">
                                    
                                           <div class="gallery-body">
                                              <label class="btn btn-primary"> add Images<input id="ImageUploader"  type="file" name="multi_upload[]" style="display:none;" multiple/></label>

                                              <table class="table table-reponsive">
                                                  {{-- <th></th>
                                                  <th></th>
                                                  <th></th>
                                                  <th></th> --}}
                                                  <tbody id="tbody">
                                                    {{-- <tr>
                                                      <td>Img021212.jpg</td>
                                                      <td>24mb</td>
                                                      <td>0%</td>
                                                      <td class="td-actions text-right">
                                                      
                                                              <a href="#" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')">
                                                                <i class="material-icons">close</i>
                                                              </a>
                                                          </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Img021212.jpg</td>
                                                        <td>24mb</td>
                                                        <td>0%</td>
                                                        <td class="td-actions text-right">
                                                        
                                                                <a href="#" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')">
                                                                  <i class="material-icons">close</i>
                                                                </a>
                                                            </td>
                                                      </tr> --}}
                                                  </tbody>
                                                </table>
                                            {{-- <div class="gallery-grid">
                                              <div class="grid-item">
                                               <a ><i class="fa fa-close"></i>
                                                  
                                               </a>
                                              <img src="{{asset('img/analog.jpg')}}"/>
                                             </div> 
                                            </div>   --}}
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
                                             <input type="text" class="form-control" name="tags">
                                          
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
                                       <div class="col-md-12 feature-image-container">
                                          <img height="200px" width="275px" id="image" class="img" src="{{asset('material/assets/img/album.png')}}">
                                          <a href="#" class="text-danger remove-feature-image">Remove Image</a>
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