<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Library\Helpers;
use Storage;
use Auth;
use Image;
use App\Category;
use App\Post;
use App\Comment;


class PostsController extends Controller
{
  
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpage =  env('PERPAGE');

        $posts = Post::with('Category','user','Comments')->paginate($perpage);

        return $posts;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('private.posts.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        ///// validate request
        $request->validate([

            'title' => 'required|string|max:255|unique:posts',

            'content' => 'required|string',

            'category' => 'required|string'

        ]);

        ///Create new Slug
        
        $slug = Helpers::Slug($request->input('title'));

        $imagepath = "";

        /// check if feature-image has file;
        if ($request->hasfile('image'))
        {    
            /// get image        
            $file = $request->file('image');
            /// upload image to storage and return image path
            $image =  Helpers::UploadImage($file);
            /// set image path 
            $imagepath = $image['location'];
        }       
    
        $post = Post::create([
            
            'title' => $request->input('title'),

            'content' => $request->input('content'),

            'user_id' => Auth::user()->id,

            'category_id' => $request->input('category'),

            'tags' => $request->input('tags'),

            'slug' => $slug,

            'featured_image' => $imagepath,

            'isPublished' => $request->input('isPublished'),

        ]);
        
        if($post)
        
            return response()->json([

                'status' => 'success',

                'message' => 'Successfully created'

            ]);
        
        else

            return response()->json([

                'status' => 'failed',

                'message' => 'Failed to create post'
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $post = Post::find($id);  
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
        //// find the post from database
        $post = Post::find($id);
        /// set input title name
        $name = $request->input('title');
        /// set the imagepath from database
        $imagepath = $post->featured_image;

        
        if(!$post->exist($id,$name)){

            $request->validate([

            'title' => 'required|string|max:255|unique:posts',

            ]);
        }

        /// check if file has an image
        if($request->hasfile('image'))
        {

            $file = $request->file('image');

            $image = Helpers::UploadImage($file);

            $imagepath = $image["location"];

        }

        //// update post from database

        $post->title = $name;

        $post->content = $request->input('content');

        $post->category_id = $request->input('category');

        $post->user_id = Auth::user()->id;

        $post->tags = $request->input('tags');

        $post->slug = Helpers::Slug($name);

        $post->featured_image = $imagepath;

        $post->ispublished = $request->input('isPublished');

        if($post->save())
        {
            return response()->json([

                'status' => 'success',

                'message' => 'Successfully updated'

            ]);
        }

        return response()->json([

            'status' => 'error',

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
       
       $post =  Post::Find($id);
       $image = $post->featured_image;
       
       if($post->delete())
       {
            //// delete image from storage
            File::delete($image);

            return response()->json([

                'status' => 'succcess',

                'message' => 'Successfully Deleted'

            ]);
       }

            return response()->json([

                'status' => 'error',

                'message' => 'Failed to Delete'

            ]);

      
    }

    public function delete(Request $request)
    {
       $ids = $request->input('id');

        $result = "";

        foreach($ids as $id)
        {

            $result =  $this->destroy($id);

        }

        if($result)

            return response()->json([

                'status' => 'success',

                'message' => 'Successfully Deleted'

            ]);
        
        else

            return response()->json([

                'status' => 'error',

                'message' => 'Failed to delete'

            ]);

    }   
    /**
     * Search the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $posts = Post::search($request->input('search'))->with('Category','user','Comments')->get();
        return $posts;
    }

    public function updatestatus(Request $request, $status)
    {
        $listid = $request->input('id');
        $result = '';
        foreach($listid as $postid)
        {
            $post = Post::find($postid);
            $post->ispublished = $status;
            $post->save();
        }


        if($result == 0)

            return response()->json([

                'status' =>  'success',

                'message' => 'Successfully updated' 

            ]);

    
    }

    public function toComments($id)
    {
        $comments = Post::find($id)->Comments;
      
      
        //  $comments = Comment::where('post_id',$id);
        // $comments =  $post->Comment();
        return  view('private.posts.toComments',['comments' => $comments]);
       
    }
}
