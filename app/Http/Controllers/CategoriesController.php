<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpage =  env('PERPAGE');
        $categories = Category::paginate($perpage);
        return $categories;
       
    }

    public function list()
    {
        return $categories = Category::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::paginate(10);
        return view('private.categories',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        

        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug')
        ]);
        return null;
        // return redirect()->route('categories')->with('success',"Category Successfully Created");
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
        $categories = Category::paginate(10);
        $category = Category::find($id);

        return view('private.category.edit',[
            'categories' => $categories,
            'category' => $category
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
  

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->slug = $request->input('slug');
        $category->save();
        return null;
        return redirect()->route('categories')->with('success',"Category Successfully Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        Category::destroy($id);
        return "";
        return redirect()->route('categories')->with('success',"Category Successfully Deleted");
    }

    public function delete(Request $request)
    {
         $ids = $request->input('id');
     
        foreach($ids as $id)
        {
            Category::destroy($id);
        }

        return redirect()->route('categories');

        
    }

    public function search(Request $request)
    {


        $request->validate([
            'search' => 'required|string'
        ]);

        $search = $request->input('search');

       
         $categories = Category::search($search)->get();
                        
                        
        return $categories;
      
       
    }
}
