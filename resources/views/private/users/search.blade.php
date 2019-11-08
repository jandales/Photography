@extends('private.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">List of Users</h4>
                  
        </div>
        <div class="card-action">
            
        </div>
        <div class="card-body">
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
           
                  <select class="custom-select mr-sm-2 roleitem" id="inlineFormCustomSelect">
                    <option selected value="0">Change role to</option>
                    <option value="1">Administrator</option>
                    <option value="2">Editor</option>
                    <option value="3">Author</option>
                  </select>
                </div>
                
                <div class="col-auto my-1">
                  <button id="changerole" type="submit" class="btn btn-primary">Submit</button>
                </div>

               

                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="{{route('users.create')}}" class="btn btn-primary">
                        <i class="material-icons">create</i> Create
                        <div class="ripple-container"></div>
                    </a>

                    <button id="users-edit" type="button" class="btn btn-primary"><i class="material-icons">create</i> Edit</button>
                    <button id="users-delete" type="button" class="btn btn-primary"><i class="material-icons">delete</i> Delete</button>
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
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Post</th>
                <th></th>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                <td> 
                  <div class="form-check">
                    <label class="form-check-label">
                    <input name="checkbox" id ="{{$user->id}}" class="form-check-input" type="checkbox">
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->firstname}} {{$user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    @switch($user->role)
                        @case(1)
                          <td>Administrator</td>
                        @break
                        @case(2)
                         <td>Editor</td> 
                        @break
                        @case(3)
                          <td>Author</td> 
                        @break
                    @endswitch
                    <td>0</td>
                    <td class="td-actions text-right">
                        <a href="/ph-admin/users/edit/{{$user->id}}" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
                          <i class="material-icons">edit</i>
                        </a>
                        <a href="/ph-admin/users/delete/{{$user->id}}" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')">
                          <i class="material-icons">close</i>
                        </a>
                    </td>
                  </tr>
                  
                @endforeach
        
         
              </tbody>
           
            </table>
         
          </div>

        </div>
      </div>
    </div>
  
  </div>
@endsection