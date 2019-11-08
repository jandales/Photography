<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpage =  env('PERPAGE');
        
        $comments = Comment::with(['replyto','post'])->orderby('created_at','desc')->paginate($perpage);

        return $comments;    
        
    }

    public function respond($id)
    {
        $respond = Comment::find($id);

        if($respond == null)

            return "";

        else        

        return $respond->fullname;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        return view('private.comments.create',['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        
        $request->validate([

            'fullname' => 'required|string|max:255',

            'email' => 'required',

            'content' => 'required',

        ]);

       
        Comment::create([

            'fullname' => $request->input('fullname'),

            'email' => $request->input('email'),

            'content' => $request->input('content'),

            'post_id' => $id,

        ]);

  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        
        return response()->json($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $comment = Comment::find($id);

          $comment->delete();

        return response()->json([

            'status' => 'success',

            'message' => 'Successfully Deleted'

        ]);        

    }


    public function ReplyByAdmin(Request $request)
    {   
        $id = $request->input('id');

        $post_id = Comment::find($id)->first()->post_id;

        $comment = new Comment();

        $comment->fullname = Auth::user()->username;

        $comment->content = $request->input('content');

        $comment->email = Auth::user()->email;

        $comment->respondto = $id;

        $comment->post_id = $post_id;

        $comment->status = 1;

        $comment->save();

        return response()->json([

            'status' => 'success',
            
            'message' => 'Successfully submitted'

        ]);
    }

    public function approved($id,$status)
    {
       
     
        $comment = Comment::find($id);

        $comment->status = $status;

        $comment->save();

        if($status == 1)
            return response()->json([

                'status' => 'success',

                'message' => 'Successfully Approved'

            ]); 

        else

            return response()->json([

                'status' => 'success',

                'message' => 'Successfully Unapproved'

            ]); 
        
    }

    public function approveds(Request $request)
    {
      
        $result = '';
        /// set array of ids into list
        $list = $request->input('id');
        $status = $request->input('status');
        
        foreach($list as $id)
        {
          $result =  $this->approved($status,$id);
        }
        
        return $result;
    }
  

    public function delete(Request $request)
    {
        /// set array of ids into list
        $list = $request->input('id');

        $result = '';
        
        foreach($list as $id)
        {

            $result =  $this->destroy($id);

        }

        return $result;
    }

   

}
