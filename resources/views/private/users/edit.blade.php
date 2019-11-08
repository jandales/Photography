@extends('private.layouts.app')

@section('content')
<div class="row">
        <div class="col-md-8" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Edit user</h4>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('users.update',[$user->id]) }}">
                            @csrf
       
     
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Username</label>
                       <input type="text" class="form-control" name="username" value="{{$user['username']}}" disabled>
                    </div>
                  </div>
                </div>

                <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Email</label>
                          <input type="text" class="form-control" name="email" value="{{$user['email']}}">
                          </div>
                        </div>
               </div>

               <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Firstname</label>
                      <input type="text" class="form-control" name="firstname" value="{{$user['firstname']}}">
                      </div>
                    </div>
              </div>

              <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Lastname</label>
                        <input type="text" class="form-control" name="lastname" value="{{$user['lastname']}}">
                      </div>
                    </div>
              </div>
    
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">New Password</label>
                      <input type="password" class="form-control" name="password">
                    </div>
                  </div>
                </div>

                <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Role</label>
                            <select name="role" class ="form-control" value="{{$user->role($user->role)}}">
                                <option value="1">Admin</option>
                                <option value="2">Editor</option>
                                <option value="3">Author</option>
                            </select>
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