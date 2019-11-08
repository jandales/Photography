<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Library\Helpers;
use Image;
use Storage;
use App\Album;
Use App\Category;
Use App\Photo;
Use Auth;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpage =  env('PERPAGE');

        return $albums = Album::with('category','user','photos')->paginate($perpage);

    }
    /** Create new album
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('private.album.create',['categories' => $categories]);
    }
    /** Store new album to into database
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        //// return null imagepath
        $imagepath = "";        
             
        ///// validate request
        $request->validate([

            'name' => 'required|string|max:255|unique:albums',

            'category' => 'required|string'

        ]);
        
        //// create album slug
        $slug = Helpers::Slug($request->input('name'));///// create slug name

        Helpers::CreateDirectory($slug); /// create folder

        ///// check if image_feature_image has file
        if($request->hasFile('image'))
        {
            $image = $request->file('image');              
            /// upload image to directory
            $images = Helpers::UploadImage($image); /// it return an arrays $filename,$location 
            /// set imagepath
            $imagepath = $images['location'];
        }    

        ///// store data into database;  
        $album = Album::create([

            'name' => $request->input('name'),

            'category_id' => $request->input('category'),

            'featured_image' => $imagepath,

            'description' => $request->input('description'),

            'tags' => $request->input('tags'),

            'user_id' => Auth::user()->id,

            'slug' => $slug,

            'published' => $request->input('status'),

        ]);
     
        if($album)
          

            return $album->id;

            return response()->json([

                'status' => 'Success',

                'message' => 'Successfully Created'

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
         /// find album
        return $album = Album::with('category','photos')->find($id);
    }
    /** Edit album
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /// find album
        $album = Album::find($id);
        ////load all categories
        $categories = Category::all();

        $photos = $album->photos()->paginate(16);        

        return view('private.album.edit',
        [
            'categories' => $categories,

            'album' => $album,

            'photos' => $photos,
   
        ]);

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


         ///// upload directory
        $directory = "uploads/";
        $album = Album::find($id);
     
        $name = $request->input('name');
         //// get the old foldername;
        $oldfoldername = $album->slug;
         /// create new slug name

         /// check if the same name
         if($album->name != $name)
         {
             /// if false create new slug name
            $slug = Helpers::Slug($name);
         }
         else
         {
            $slug = $album->slug;
         }
        
        /// check if incoming name is already exist in the database
        if(!$album->exist($id,$name))
        {
            ///// validate request
            $request->validate([
                'name' => 'required|string|max:255|unique:albums',
            ]);
        }        
   
        ///// check if image_feature_image has file
        if($request->hasFile('image'))
        {
            //// set the input file to $image variable
            $image = $request->file('image');             
            /// upload image to directory
            $images = Helpers::UploadImage($image); /// it return an arrays $filename,$location 
            /// set imagepath
            $imagepath = $images['location'];
        }
        else
        {
            //// return null imagepath
            $imagepath = $album->featured_image;
        }
     
        /// update album from database;
        $album->name = $name;

        $album->category_id = $request->input('category');

        $album->featured_image = $imagepath;

        $album->tags = $request->input('tags');

        $album->published = $request->input('status');

        $album->slug = $slug;

        $album->save();        
 
        if($oldfoldername != $slug)
            /// rename foldername
            Helpers::RenameFolder($oldfoldername,$slug); 
         
        
        return response()->json([

            'status' => 'success',

            'message' => 'Successfully updated'
            
        ]);
            
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       
        $album = Album::find($id);
        
        $path = "uploads/".$album->slug;
        $image = $album->featured_image;

        //// deleting photos from photos table associated by this album
        Photo::where('album_id',$id)->delete();
               
        if($album->delete())
        {
           File::delete($image);
           File::deleteDirectory($path);

           
           return response()->json([
 
            'status' => 'success',

            'message' => 'Successfully Deleted'

           ]);


        }   
        
         
        return response()->json([
 
            'status' => 'Failed',

            'message' => 'Failed to Deleted'

           ]);
      
 
        
 
           
    } 
    
   
    public function delete(Request $request)
    {
        //// get list of ids
        $ids = $request->input('id');  

        foreach($ids as $id)
        {
            ////deleting album from database
            $this->destroy($id);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully Deleted'
        ]);

    }
    ///Delete single Photo
    public function deletePhoto($id)
    {
      /// find photo from database          
      $photo = Photo::find($id);
      ///delete photo from database
      $photo->delete();
      /// delete photo from file storage
      File::delete($photo->location);      
        
     
      return response()->json([

            'status' => 'success',

            'message' => 'Successfully Deleted'

      ]);

    }     
    ///delete Multiple Photo
    public function deletePhotos(Request $request)
    {
       
        $listId = $request->input('id');
      
        $album_id = "";
        
        $count = 0;

        foreach($listId as $id)
        {
          $count =  $this->deletePhoto($id);
        }   
      
        return $count;
    }


    public function search(Request $request)
    {
        $request->validate([

            'search' => 'required|string'

        ]);

        $search = $request->input('search');
        
        $albums = Album::search($search)
                        ->with('category','user','photos')
                        ->get();

         return $albums;
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function AddPhotos(Request $request,$id)
    {
        /// find album
        $album = Album::find($id);

        //// set album slug
        $slug = $album->slug;
        /// get images from input file
        $images =  $request->file('images');
        /// set pathimage
        $path =  $slug;

        /// count images in album
        $count = $album->photos()->count();

        /// chech input file if has file
        if($request->hasFile('images'))
        {   
            
            foreach ($images as  $image) {
                      
                /// upload image to directory
                $imagepath = Helpers::UploadImage($image,$path); /// it return an arrays $filename,$location
                
                ////store image into database
                $photo = New Photo();
                $photo->name = $imagepath['name'];
                $photo->location = $imagepath['location'];
                $photo->album_id = $album->id;
                $photo->save();
            

            }
             
  
        }

    }

    
 

    public function upload(Request $request)
    {

    $id = $request->input('id');
    /// find album
    $album = Album::find($id);
    //// set album slug
    $slug = $album->slug;
    /// set pathimage
    $path =  $slug;

    $result = '';


    /// count images in album
    $count = $album->photos()->count();

    /// chech input file if has file
    if($request->hasFile('images'))
    {   
        // get images from input file
        $images =  $request->file('images');
        
            foreach ($images as  $image)
            {
                    
                /// upload image to directory
                $imagepath = Helpers::UploadImage($image,$path); /// it return an arrays $filename,$location            

                ////store image into database
                $photo = New Photo();

                $photo->name = $imagepath['name'];

                $photo->location = $imagepath['location'];

                $photo->album_id = $album->id;

                $photo->size = $imagepath['size'];

                $photo->save();
            

            }
        

        } 


        return response()->json([

            'status' => 'success',

            'message' => 'Successfully Updated'

        ]);
        
            
    }




    

   
}
