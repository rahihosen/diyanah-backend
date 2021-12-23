<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Product_tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Image;
use DB;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('deleted_at')->OrderBy('id', 'DESC')->get();
        return view('admin.product.index')->with(compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  Category::latest()->get();
        $units = Unit::where('deleted_at')->get();
        $tags = Tag::where('deleted_at')->get();

        return view('admin.product.create', compact('categories', 'units', 'tags'));
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
            'product_name' => 'required',
            'product_image' => 'required|mimes: jpg,png,jpeg',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
        ]);
        $product = new Product;
        $product->login_id = Auth::user()->id;
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->product_name = $request->product_name;
        $product->product_slug = $request->product_slug;
        $product->product_code = $request->product_code;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->status = $request->status;

        $product_image = $request->product_image;

        if($product_image){
            $image_name= hexdec(uniqid()).'.'.$product_image->getClientOriginalExtension();
            $path = public_path('/product/');
            Image::make($product_image)->resize(300,300)->save($path.$image_name);
            $product->product_image= $image_name;
            $insert = $product->save();
        }
        //for insert multiple tag start

        $tag_data = $request->tag_id;
        if ($tag_data){

            foreach($tag_data as $value)
            {
                $product_tag = [];
                $product_tag['tag_id'] = $value;
                $product_tag['product_id']= $product->id;
                $product_tag['created_at']= Carbon::now();
                DB::table('product_tags')->insert($product_tag);
            }
        }
        //for insert multiple tag end
        $notification=array(
            'messege'=>'Product Inserted Successfully',
            'alert-type'=>'success'
        );


        if ($insert) {
            return redirect()->route('products.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add Product']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        $units = Unit::where('deleted_at')->get();


        $product_tag_list = Product_tag::where('product_id', $product->id)->get()->toArray();

        //for selected tags start
        $product_tag = [];
        foreach ($product_tag_list as  $value) {
             $data['product_tag'] =  $value['tag_id'];
            array_push($product_tag, $data['product_tag']);
        }
        //for selected tags end

        $tags = Tag::where('deleted_at')->get();
        return view('admin.product.edit')->with(compact(['product', 'categories','product_tag','product_tag_list','units','tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {


        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->product_name = $request->product_name;
        $product->product_slug = $request->product_slug;
        $product->product_code = $request->product_code;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->status = $request->status;

        $old_one=$request->old_one;
        $image_one=$request->product_image;

        $data=array();

        if(!empty($image_one)) {

            $image_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            $path = public_path('/product/');
            Image::make($image_one)->resize(300,300)->save($path.$image_name);

            $product->product_image = $image_name;

            $update = $product->update();

            $notification=array(
                'messege'=>'Product updated Successfully',
                'alert-type'=>'success'
            );
        }

        //for insert multiple tag start
        DB::table('product_tags')->where('product_id', $product->id)->delete();
        $tag_data = $request->tag_id;
        if ($tag_data){
            foreach($tag_data as $value)
            {
                $product_tag = [];
                $product_tag['tag_id'] = $value;
                $product_tag['product_id']= $product->id;
                $product_tag['created_at']= Carbon::now();
                DB::table('product_tags')->insert($product_tag);
            }
        }
        //for insert multiple tag end
        
        $update = $product->update();

        $notification=array(
            'messege'=>'product Updated Successfully',
            'alert-type'=>'success'
        ); 
        if ($update) {
            return redirect()->route('products.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to update Product.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{
            $product->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }
}
