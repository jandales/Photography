@extends('private.layouts.app')
@section('content')
<form method="post" action="{{route('profile.update',[$user['id']])}}"  enctype="multipart/form-data">
<div class="row">

  <div class="col-md-8">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Edit Profile</h4>
        <p class="card-category">Complete your profile</p>
      </div>
      <div class="card-body">
    
          @csrf
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label class="bmd-label-floating">Company</label>
                <input type="text" class="form-control" disabled value="Photography">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="bmd-label-floating">Username</label>
              <input type="text" class="form-control" value="{{$user['username']}}" disabled>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="bmd-label-floating">Email address</label>
                <input type="email"  name="email" class="form-control" value="{{$user['email']}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Fist Name</label>
              <input type="text" name="firstname" class="form-control" value="{{$user['firstname']}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Last Name</label>
                <input type="text" name="lastname" class="form-control" value="{{$user['lastname']}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Address</label>
              <input type="text" name="address" class="form-control"  value="{{$user['address']}}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>About Me</label>
                <div class="form-group">
                <textarea name="aboutme" class="form-control" rows="5">{{$user['aboutme']}}</textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">New Password</label>
              <input type="text" name="password" class="form-control"  value="">
              </div>
            </div>
          </div>
         
          <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
          <div class="clearfix"></div>
   
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-profile">
       
      <div class="card-avatar">
          
        <a href="#pablo">
          @if($user->avatar == null)
          <img  id="image" class="img" src="{{asset('material/avatar/avatar.png')}}" />
          @else
          <img  id="image" class="img" src="{{asset('material/avatar/'.$user->avatar)}}" />
          @endif
        </a>
 
      </div>
      <div class="card-body">
        <h6 class="card-category text-gray">{{$user->role()}}</h6>
      <h4 class="card-title">{{$user->fullname()}}</h4>
        <p class="card-description">
         {{$user->aboutme}}
        </p>
        <div class="td-actions text-center">
            <label rel="tooltip" title="Upload Image" class="btn btn-primary btn-link btn-sm">
              <i class="material-icons">insert_photo</i>
              <input id="imgInp"  type="file" name="image" style="display:none;">
            </label>
            <a href="/ph-admin/profile/remove/{{$user->id}}" rel="tooltip" title="Remove Image" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')">
              <i class="material-icons">close</i>
            </a>
          </div>
        
      </div>
    </div>
  </div>





</div>

</form>
    
@endsection