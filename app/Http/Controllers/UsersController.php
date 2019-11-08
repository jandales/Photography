<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Image;
use Storage;
use App\User;
use Auth;


class UsersController extends Controller
{

    public function index()
    {
        $perpage =  env('PERPAGE');

        $users = User::with('postcount')->paginate($perpage);

        return $users;  

    }

    public  function active()
    {
        return Auth::user();
    }

    public function create()
    {
        
        return view('private.users.create');

    }

    public function store(Request $request)
    {


        $request->validate([

            'username' => 'required|string|max:255|unique:users',

            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string|min:8',

        ]);

        User::create([

           'username' => $request['username'],

           'email' => $request['email'],

           'password' => Hash::make($request['password']),

           'firstname' => $request['firstname'],

           'lastname' => $request['lastname'],

           'role' => $request['role'],

        ]);

        return response()->json([

            'status' => 'success',

            'message' => 'successfully user Created'

        ]);
   
    }

    public function edit($id)
    {

        $user = User::find($id);

        return response()->json($user);
      
    }

    public function update(Request $request, $id)
    {

  
        $user = User::find($id);

        $password = $request['password'];

        if($password == null)
        {
           $password =  $user->password;
        }
        else
        {
            $password = Hash::make($password);
        }       
      
        if(!$user->emailExist($id,$request['email']))
        {          
            $request->validate([

                'email' => 'required|string|email|max:255|unique:users',

            ]);
            
        }
     
        $user->email = $request['email'];

        $user->firstname = $request['firstname'];

        $user->lastname = $request['lastname'];

        $user->role = $request['role'];

        $user->password = $password;  

        $user->save();
       
        return response()->json([

            'status' => 'success',

            'message' => 'successfully user updated'

        ]);
    }

    public function destroy($id)
    {

        if(Auth::user()->id == $id)
        
            return response()->json([

                'status' => 'error',

                'message' => 'Cannot delete this user'

            ]); 

        
        
        else

            $user = User::destroy($id);
            
            if($user)
            
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully deleted'

                ]);     
            

    }

    public function delete(Request $request)
    {
        $ids = $request['id'];
        $result = "";

        foreach($ids as $id)
        {
            if(Auth::user()->id != $id)
            {
                $result =  $this->destroy($id);
            }
      
        }

        return $result;
    }

    public function changeRole(Request $request,$id)
    {
        $result = '';

        foreach($request->input('id') as $userid)
        {
            $user =  User::find($userid);

            $user->role = $id;

            $result = $user->save();

        }

        if($result)

        {

            return response()->json([

                'status' => 'success',

                'message' => 'Successfully Change Role'

            ]);   

        }
      
    
  
    }

    public function updateprofile(Request $request)
    {

          

        $id = Auth::user()->id;

        $user = User::find($id);

        $email = $request['email'];      

        $password = $request['password'];

   
        
        if( !$user->emailExist($id,$email) )

        {          
           
            $request->validate([

                'email' => 'required|string|email|max:255|unique:users',

            ]);

            
        }

       
        $user->avatar = $user->avatar;

        if ( $request->hasFile('image') ) {

            $image = $request->file('image');  

            $filename = now()->timestamp . '.'.$image->getClientOriginalExtension();

            $path = '/img/avatar/'.$filename;

            $location = public_path($path);

            Image::make($image)->resize(128, 128)->save($location);            

            $user->avatar = $path;              

        }     

        $user->email = $request['email'];

        $user->firstname  = $request['firstname'];

        $user->lastname = $request['lastname'];

        $user->aboutme = $request['aboutme'];

        $user->address = $request['address'];

        $user->save();

        return response()->json([

            'status' => 'success',

            'message' => 'Successfully profile updated'

        ]);  

       
    }

    public function search(Request $request)
    {     

        $request->validate([

            'search' => 'required|string|max:255',

        ]);

        $users = User::search($request->input('search'))->with('postcount')
                     ->get();

        return $users;
 
       

      
    }

    public function removeAvatar($id)
    {       
           $path = "material/avatar/";

           $user = User::find($id);

           File::delete($path . $user->avatar);

           $user->avatar = null;

           $user->save();

           return redirect()->route('profile');
    }


    public function GetActiveUser()
    {
       return Auth::user();
    }

    
}
