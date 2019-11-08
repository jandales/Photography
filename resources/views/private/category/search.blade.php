@extends('private.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
            <div class="form-row align-items-center">
                <div class="col-9 my-1">
                    <h4 class="card-title">List of Categories</h4>
                </div>
                  <form class="navbar-form" method="get" action="{{route('categories.search')}}">
                      <div class="input-group no-border">
                      <input type="text" name="search" value="{{ isset($search) ? $search : '' }}" class="form-control txtsearch" placeholder="Search...">
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                          <i class="material-icons">search</i>
                          <div class="ripple-container"></div>
                        </button>
                      </div>
                    </form>
              </div>
  
        </div>
        <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <form class="col-md-10" method="post" action="{{route('categories.store')}}">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Create New Category</label>
                      
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input type="text" name='name' class="form-control">
                      </div>
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
                        <label class="bmd-label-floating">Slug</label>
                        <input type="text" class="form-control" name="slug">
                        <span class="form-label">Slug must have dash between words!</span>
                      </div>
                    </div>
                  </div>
          
                  <button type="submit" class="btn btn-primary pull-right">Save</button>
                  <div class="clearfix"></div>
                </form>
              </div>
              <div class="col-md-6">
                  <div class="form-row align-items-center">
                      
                     
      
                      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                          <div class="btn-group mr-2" role="group" aria-label="First group">
                          <a href="{{route('categories.create')}}" class="btn btn-primary">
                              <i class="material-icons">create</i> Create
                              <div class="ripple-container"></div>
                          </a>
      
                          <button id="category-edit" type="button" class="btn btn-primary"><i class="material-icons">create</i> Edit</button>
                          <button id="category-delete" type="button" class="btn btn-primary"><i class="material-icons">delete</i> Delete</button>
                        </div>
                                           
                      </div>
      
                     
      
                     
                  </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                        <th>  
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="">
                                <span class="form-check-sign">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          </th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Slug</th>
                      <th colspan="2"></th>
                    
                    </thead>
                    <tbody>
                     
                      @if(Count($categories) > 0)
                      
                      @foreach ($categories as $category)
                      <tr>
                          <td> 
                              <div class="form-check">
                                <label class="form-check-label">
                                <input name="checkbox" id ="{{$category->id}}" class="form-check-input" type="checkbox">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                      <td>{{$category->name}}</td>
                      <td>{{$category->description}}</td>
                      <td>{{$category->slug}}</td>  
                          <td class="td-actions text-right">
                            <a href="/ph-admin/categories/edit/{{$category->id}}" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
                              <i class="material-icons">edit</i>
                            </a>
                            <a href="/ph-admin/categories/delete/{{$category->id}}" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')">
                              <i class="material-icons">close</i>
                            </a>
                        </td>
                        </tr>
                     
                          
                      @endforeach
                      @else
                      <tr>
                        <td colspan="4" class="text-center">No Category Found</td>
                      </tr>
                      @endif
                   
                    </tbody>
                  </table>
                  {{$categories->links()}}
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>

  </div>
@endsection