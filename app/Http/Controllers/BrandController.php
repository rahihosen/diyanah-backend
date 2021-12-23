<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Auth;
use Image;

class BrandController extends Controller
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
        $brand = Brand::where('deleted_at')->OrderBy('id', 'DESC')->get();
        return view('admin.brand.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'brand_image' => 'required|mimes: jpg,png,jpeg',
            'brand_title' => 'required',
        ]);
        $brand = new Brand;
        $brand->created_by = Auth::user()->id;
        $brand_image = $request->brand_image;
        $brand->brand_title = $request->brand_title;

        if($brand_image){
            $image_name= hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            $path = public_path('/brand/');
            Image::make($brand_image)->resize(300,300)->save($path.$image_name);
            $brand->brand_image= $image_name;
            $insert = $brand->save();
        }
        
        $notification=array(
            'messege'=>'Brand Inserted Successfully',
            'alert-type'=>'success'
        );


        if ($insert) {
            return redirect()->route('brands.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add brands.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit')->with(compact(['brand']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'brand_image' => 'required|mimes: jpg,png,jpeg',
            'brand_title' => 'required',
        ]);
        $brand->created_by = Auth::user()->id;
        $brand->brand_title = $request->brand_title;

        $old_one=$request->old_one;
        $image_one=$request->brand_image;


        if($image_one) {

            $image_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            $path = public_path('/brand/');
            Image::make($image_one)->resize(300,300)->save($path.$image_name);

            $brand->brand_image = $image_name;

            $insert = $brand->update();

            $notification=array(
                'messege'=>'Brand updated Successfully',
                'alert-type'=>'success'
            );

            if ($insert) {
                return redirect()->route('brands.index')->with($notification);
            }
        }


        return redirect()->back()->with(['error' => 'Unable to update Brand']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */

    public function destroy(Brand $brand)
    {
        try{
            $brand->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }

    // public function destroy(Brand $brand)
    // {

    //     $brand->delete();

    //     $notification=array(
    //         'messege'=>'Brand deleted Successfully',
    //         'alert-type'=>'warning'
    //     );
    //     return redirect()->route('brands.index')->with($notification);
    // }
}
