@extends('private.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
        
          <div class="form-row align-items-center">
              <div class="col-9 my-1">
                  <h4 class="card-title">List of Posts</h4>
              </div>
                <form class="navbar-form" method="get" action="{{route('posts.search')}}">
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
                <div class="col-auto my-1">
           
                  <select class="custom-select mr-sm-2 changevalue" id="inlineFormCustomSelect">
                    <option selected value="3">Change status to</option>
                    <option value="2">Published</option>
                    <option value="1">Unpublished</option>
                    <option value="0">Draft</option>
                  </select>
                </div>
                
                <div class="col-auto my-1">
                  <button id="posts-changestatus" type="submit" class="btn btn-primary">Submit</button>
                </div>              

                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                      <a href="{{route('posts.create')}}" class="btn btn-primary">Create</a>
                      <button id="posts-edit" type="button" class="btn btn-primary">Edit</button>
                      <button id="posts-delete" type="button" class="btn btn-primary">Delete</button>
                      <button id="posts-comments" type="button" class="btn btn-primary">Comments</button>
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
                <th style="width:40%">Title</th>
                <th>Author</th>
                <th>Categories</th>
                <th><i class="fa fa-comment"></i></th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
         
              </thead>
              <tbody>
                @if(Count($posts) > 0)
                @foreach($posts as $post)
                  <tr>
                    <td> 
                      <div class="form-check">
                        <label class="form-check-label">
                        <input name="checkbox" id ="{{$post->id}}" class="form-check-input childCheckbox" type="checkbox">
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                        </label>
                      </div>
                    </td>
                      <td>{{$post->title}}</td>
                      <td>{{$post->user->username}}</td>
                      <td>{{$post->category->name}}</td>
                      <td><a href="{{route('posts.comments',[$post->id])}}">{{$post->comments()->count()}}</a></td>
                      <td>{{$post->status($post->ispublished)}}</td>
                      <td>{{$post->created_at}}</td>
                      <td class="td-actions text-right">
                          <a href="{{route('posts.edit',[$post->id])}}" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </a>
                          <a href="{{route('posts.destroy',[$post->id])}}" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="material-icons">close</i>
                          </a>
                     </td>
                    </tr>                  
                @endforeach
                @else
                  <tr><td colspan="6" class="text-center">{{"Post not found"}}</td></tr>
                @endif
        
         
              </tbody>
           
            </table>
            {{-- {{$users->links()}} --}}
          </div>

        </div>
      </div>
    </div>
  
  </div>
@endsection