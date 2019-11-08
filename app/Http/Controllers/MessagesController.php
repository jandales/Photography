<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Message;
use App\User;
use Auth;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpage =  env('PERPAGE');

        $inbox =  Message::where([['type', '=',0],['isArchived','=',0],['isTrashed','=', 0 ]])

                            ->orderBy('created_at', 'desc')

                            ->paginate($perpage);

        return response()->json($inbox);
       
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sentBox()
    {
        return Message::where('type',1)
                        ->where('isTrashed',0)
                        ->where('isArchived',0)
                        ->orderBy('created_at', 'desc')
                        ->paginate(2);
    }

    public function archived(){

        return Message::where([['isArchived','=',1],['isTrashed','=', 0 ]])
                      ->orderBy('created_at', 'desc')
                      ->paginate(5);
    }

    public function trash(){

        return Message::where([['isArchived','=',0],['isTrashed','=', 1 ]])
                      ->orderBy('created_at', 'desc')
                      ->paginate(5);

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  Message::find($id);
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
        $message = Message::find($id);

        $message->delete();

        return response()->json([

            'status' => 'success',

            'message' => 'Successfully Deleted'

        ]);
    }
   
    public function deletes(Request $request)
    {
        $listid = $request->input('id');

        foreach($listid as $id)
        {
             $this->destroy($id);
        }

        return response()->json([

            'status' => 'success',

            'message' => 'Successfully Deleted'

        ]);
    }

    public function SendbyAdmin(Request $request)
    {



        $request->validate([

            'email' => 'required|string',

            'subject' => 'required|string'

        ]);   
     

        Message::create([

            'fullname' => auth()->user()->username,

            'email_from' => auth()->user()->email,

            'email_to' => $request->input('email'),

            'subject' => $request->input('subject'),

            'message' => $request->input('message'),

            'type' => 1,

        

        ]);

        return response()->json([

            'status' => 'success',

            'message' => 'Mesage has sent'
            
        ]);
    }

    public function sendbyClient(Request $request)
    {
        Message::create([

            'fullname' => $request->input('fullname'),

            'email_from' => $request->input('email'),

            'email_to' => Auth::user()->email,

            'subject' => $request->input('subject'),

            'message' => $request->input('message'),

            'isRead' => 0,

            'type' => 0,

        

        ]);

        return response()->json([

            'status' => 'success',

            'message' => 'Mesage has sent'
            
        ]);
    }

    public function read($id)
    {

     
        $message = Message::find($id);

        $message->isRead = 1;

        $message->save();

        return $message;
    }

    public function unread($id)
    {

     
        $message = Message::find($id);

        if($message->isRead != 0)
        {
            $message->isRead = 0;

            $message->save();

        }

        return response()->json([
            'status' => 'success',
             'message' => 'Successfully updated'
        ]);

    }

    public function readOrUnreads(Request $request,$value)
    {

     
        $listid = $request->input('id');


        foreach($listid as $id)
        {
            $this->readOrUnread($id,$value);
        }

        return response()->json([
            'status' => 'success',
             'message' => 'Successfully updated'
        ]);

    }

    public function Count($id)
    {
        return Message::where('type',$id)->count();
    }


    public function isArchived($id){

        $message = Message::find($id);
     
        $message->isArchived = 1;        

        $message->isTrashed = 0;    

        $message->save();

        return response()->json([

            'status' => 'success',

             'message' => 'Sent to archived'

        ]);

    }

    public function isArchiveds(Request $request)
    {

        $listid = $request->input('id');


        foreach($listid as $id)
        {
            
            $this->isArchived($id);

        }

        return response()->json([

            'status' => 'success',

             'message' => 'Sent to archived'

        ]);

    }
    public function unarchived($id){

        $message = Message::find($id);
     
        $message->isArchived = 0;        

        $message->isTrashed = 0;    

        $message->save();

        return response()->json([

            'status' => 'success',

             'message' => 'Message Unarchived'

        ]);

    }
    public function unarchiveds(Request $request){


        $list  =  $request->input('id');

        foreach($list as $id)
        {
            $this->unarchived($id);
        }
        

        return response()->json([

            'status' => 'success',

             'message' => 'Message Unarchived'

        ]);

    }


 

    public function isTrashed($id)
    {

        $message = Message::find($id);

        $message->isArchived = 0;

        $message->isTrashed = 1;

        $message->save();

        return response()->json([

            'status' => 'success',

            'message' => 'Mesage sent trash'
            
        ]);


    }

    public function isTrasheds(Request $request)
    {
        
      $list  = $request->input('id');

        foreach($list as $id)        {   
                      
            $this->isTrashed($id);
        }

    
        return response()->json([

            'status' => 'success',

            'message' => 'Mesage sent trash'
            
        ]);


    }

    public function restore($id)
    {

        $message = Message::find($id);

        $message->isArchived = 0;

        $message->isTrashed = 0;

        $message->save();

        return response()->json([

            'status' => 'success',

            'message' => 'Message Restore'
            
        ]);


    }

    public function restores(Request $request)
    {
        
        $list  = $request->input('id');

        foreach($list as $id)        {   
                      
            $this->restore($id);
        }

    
        return response()->json([

            'status' => 'success',

            'message' => 'Message Restore'
            
        ]);


    }
}
