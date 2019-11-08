@extends('private.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
        
          <div class="form-row align-items-center">
              <div class="col-9 my-1">
                  <h4 class="card-title">List of Albums</h4>
              </div>
                <form class="navbar-form" method="get" action="{{route('albums.search')}}">
                    <div class="input-group no-border">
                  
                    <input type="text" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" class="form-control txtsearch" placeholder="Search...">
                      <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                      </button>
                    </div>
                </form>
          
           

          </div>



        </div>
       
        <div class="card-body">
            <div class="form-row align-items-center">
               
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="{{route('albums.create')}}" class="btn btn-primary">
                        Create
                        <div class="ripple-container"></div>
                    </a>
                    <button id="albums-edit" type="button" class="btn btn-primary">Edit</button>
                    <button id="albums-delete" type="button" class="btn btn-primary">Delete</button>
                  </div>
                                     
                </div>

            </div>
        
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>  
                  <div class="form-check">
                    <label class="form-check-label">
                      <input id="perentCheckbox" class="form-check-input" type="checkbox" value="">
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </th>
                <th>Name</th>
                <th>Category</th>
                <th>Photos</th>
                <th>Author</th>
                <th>Status</th>
                <th>Created</th>
                 <th></th>
              </thead>
              <tbody> 
                @if (count($albums) ==0)
                    <tr>
                      <td style="text-align:center; font-size:20px; text-transform:capitalize;" colspan="7  ">No Album found</td>
                    </tr>
                @else
                @foreach ($albums as $album)
                <tr>
                    <td> 
                      <div class="form-check">
                        <label class="form-check-label">
                        <input name="checkbox" id ="{{$album->id}}" class="form-check-input childCheckbox" type="checkbox">
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                        </label>
                      </div>
                    </td>
                        <td>{{$album->name}}</td>
                        <td>{{$album->category->name}}</td>
                       <td>{{$album->photos->count()}}</td>
                        <td>{{$album->user->username}}</td>
                        <td>{{$album->status()}}</td>
                        <td>{{$album->created_at}}</td>
                        <td class="td-actions text-right">
                        <a href="/ph-admin/albums/edit/{{$album->id}}" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
                              <i class="material-icons">edit</i>
                            </a>
                            <a href="/ph-admin/albums/delete/{{$album->id}}" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')">
                              <i class="material-icons">close</i>
                            </a>
                        </td>
                      </tr>
                @endforeach
                @endif      
               
              </tbody>
           
            </table>
           
          </div>

        </div>
      </div>
    </div>
  
  </div>
@endsection