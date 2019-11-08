p@extends('private.auth.app')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-8  col-sm-12" style="margin:50px auto">
      <div style="margin-bottom: 50px">
        <h2 class="text-center">Campany Name</h2>
      </div>
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Login</h4>
          <p class="card-category">Enter your credentials</p>
        </div>
        <div class="card-body">
          <form method="POST" action="">
            @csrf
   
 
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Username / Email</label>
                  <input type="text"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
                 @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Password</label>
                  <input type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                  @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
                </div>
              </div>
            </div>
         
           <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" value="">
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                          Remember Me
                        </label>
             </div>
             <a href="">Forgot your password?</a>
            <button type="submit" class="btn btn-primary pull-right">Login</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection