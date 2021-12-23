<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $categories = Category::where('deleted_at')->OrderBy('id', 'DESC')->get();
        return view('admin.categories.index')->with(compact(['categories']));
    }


    public function create()
    {
        $categories = Category::where('deleted_at')->get();

        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',
        ]);
        $category = new Category;
        $category->created_by = Auth::user()->id;
        $category->category_name = $request->category_name;
        $category->parent_id = $request->parent_id ? $request->parent_id : 0;
        $category->status = $request->status;

        $insert = $category->save();
        $notification=array(
            'messege'=>'Category Inserted Successfully',
            'alert-type'=>'success'
        );

        if($insert){
            return redirect()->route('categories.index')->with($notification);
        }
        return redirect()->back()->with(['error' => 'Unable to add Category.']);
    }



    public function edit(Category $category)
    {
        $categories = Category::where('deleted_at')->get();
        return view('admin.categories.edit')->with(compact(['category', 'categories']));
    }




    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
        $category->category_name = $request->category_name;
        $category->parent_id = $request->parent_id ? $request->parent_id : 0;
        $category->status = $request->status;
        $update = $category->update($request->all());

        $notification=array(
            'messege'=>'Category updated Successfully',
            'alert-type'=>'success'
        );
        if ($update) {
            return redirect()->route('categories.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to update category.']);
    }



    public function destroy(Category $category)
    {
        $category->delete();

        $notification=array(
            'messege'=>'Category deleted Successfully',
            'alert-type'=>'success'
        );
       return redirect()->route('categories.index')->with($notification);
    }

    public function check_category_avalibility(Request $request)
    {
        $category_name=  $request->input('category_name');

        $data = DB::table('categories')->where('category_name', 'Like', $category_name)->get();
        if($data>0){
            echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span>This Name Already Exist </label>';
        }else{
            echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Available</label>';
        }
    }

}
