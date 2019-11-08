
@if(count($errors) > 0)
    @foreach($errors->all() as $error)

    <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
            </button>
            <span>
              <b> Alert - </b>    {{$error}}</span>
    </div>
       
    @endforeach
@endif

@if(session('success'))

<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="material-icons">close</i>
        </button>
        <span>
          <b> Success : </b> {{session('success')}}</span>
</div>


@endif

@if(session('error'))
<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="material-icons">close</i>
        </button>
        <span>
          <b> Warning : </b> {{session('error')}}</span>
</div>

@endif