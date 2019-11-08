@extends('private.layouts.app')

@section('content')
<div class="row">
        <div class="col-md-8" style="margin:0 auto">
         
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Create comments</h4>
            
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('comments.store',[$id])}}" enctype="multipart/form-data">
                            @csrf
       
     
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Name</label>
                        <input type="text" class="form-control" name="fullname">
                    </div>
                  </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Email</label>
                          <input type="text" class="form-control" name="email">
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Comments</label>
                         <textarea rows="10" class="form-control" name="content"></textarea>
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