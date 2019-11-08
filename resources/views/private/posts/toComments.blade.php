@extends('private.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">List of Comments</h4>
        </div>
        <div class="card-body">

            <div class="form-row align-items-center">
                <div class="col-auto my-1">
           
                  <select class="custom-select mr-sm-2 changevalue" id="inlineFormCustomSelect">
                    <option selected value="3">Change status to</option>
                    <option value="1">Approved</option>
                    <option value="0">Unapproved</option>
                    <option value="2">Delete</option>
                  </select>
                </div>
                
                <div class="col-auto my-1">
                  <button id="cmdCommand" type="submit" class="btn btn-primary">Submit</button>
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
                <th>Comment</th>
                <th>In Reponse to</th>                            
                <th>Submitted on</th>
              </thead>
              <tbody>               
                
                @if (count($comments) == 0)
                  <tr>
                    <td colspan="5" class="text-center">No Comment Found</td>                           
                  </tr>
                @else
                  
                    @foreach ($comments as $comment)
                    <tr>
                        <td class="Input-Check"> 
                            <div class="form-check">
                              <label class="form-check-label">
                              <input name="checkbox" id ="{{$comment->id}}" class="form-check-input childCheckbox" type="checkbox">
                                <span class="form-check-sign">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          </td>
                      <td class="author">
                       <div>
                          <strong>
                              <img  class="pull-left" height="32px" src="{{asset('material/avatar/avatar.png')}}"/>
                              <span class="author-name">{{$comment->fullname}}</span>
                          </strong>
                          <br>
                        <a href="#">{{$comment->email}}</a>
                       </div>
                       
                      </td>
              
                      <td class="comment-author">
                        @if ( count($comment->reply()) != 0 )
                        <span>In reply to : <a href="#">{{$comment->reply()->fullname}}</a></span>                                   
                        @endif
                     
                              <p>{{$comment->content}}</p>
                       <div class="td-row-action">
                         @if ($comment->status == 0)
                           <span><a href="/ph-admin/comments/status/1/{{$comment->id}}" class="text-primary">Approved</a></span>
                         @else
                           <span><a href="/ph-admin/comments/status/0/{{$comment->id}}"  class="text-warning">Unapproved</a></span>  
                         @endif    
                         <span><a href="#" id={{$comment->id}} class="text-info linkReply">Reply</a></span>
                       <span><a href="{{route('comments.destroy',[$comment->id])}}" class="text-danger">Delete</a></span>
                     
                       </div>
                      </td>



                      <td class="td-Inrespond"><a href="#">{{str_limit($comment->Post->title,15)}}</a></td>
                      <td class="td-submitted">{{$comment->created_at}}</td>  
                      {{-- <td><a href="#" data-toggle="modal" data-target="#myModal">Reply</a></td>                --}}
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

  
  <!-- Modal -->
  <div class="modal fade" id="ReplyModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Reply to : <span id="model-auhtor"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="formreply" method="POST" action="#">
                @csrf
           
           <input type="hidden" id="respondtoID" name="respondID" />
           <input type="hidden" id="fullname"  name="fullname" />
           <input type="hidden" id="email"  name="email" />
           <input type="hidden" id="id" name="id"/>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label class="bmd-label-floating">Type your reply here...</label>                                     
                        <textarea rows="5" id="comment" class="form-control" name="content">      
                    </textarea>
                  </div>
                </div>
              </div>

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnReply" class="btn btn-default" data-dismiss="modal">Submit</button>
        </div>
      </div>
      
    </div>
  </div>
@endsection