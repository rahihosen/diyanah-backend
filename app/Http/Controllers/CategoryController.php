<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Categoryrequest;
use DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index')->with(compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     
    public function create()
    {
        $categories = Category::latest()->get();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $input = $request->all();
        $image = $request->file('category_icon');  
        if ($image) {
            $image_name=  md5(time() . '_' . $image) . '.' . $image->getClientOriginalExtension();
            $path = public_path('/category-icon/');
            $image->move($path, $image_name);
            $input['category_icon'] = $image_name;
        }
        try{
            DB::transaction(function()use($input){
               Category::create($input);
            });
            $notification=array(
                'messege'=>'Category Inserted Successfully',
                'alert-type'=>'success'
            );    
            return redirect()->route('categories.index')->with($notification);
        }
        catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::latest()->get();
        return view('admin.categories.edit')->with(compact(['category', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    { 
        $input = $request->all();
        $image = $request->file('category_icon');
        if ($image) {
            $old_image = $request->old_image;
            $image_name=  md5(time() . '_' . $image) . '.' . $image->getClientOriginalExtension();
            $path = public_path('/category-icon/');
            $image->move($path, $image_name);
            $input['category_icon'] = $image_name; // change your request image name
                if($old_image){
                    unlink($path.$old_image);
                }
           }

        try{
            DB::transaction(function()use($category,$input){
                $category->update($input);
            });
            $notification=array(
                'messege'=>'Category Updated Successfully',
                'alert-type'=>'success'
            );    
            return redirect()->route('categories.index')->with($notification);
        }
        catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }
}
