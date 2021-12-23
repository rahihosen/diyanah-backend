<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Image;

class AdsController extends Controller
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

        $promotion = Ads::where('deleted_at')->OrderBy('id', 'DESC')->get();

        return view('admin.ads.index',compact('promotion'));
//        return view('admin.ads.index')->with(compact(['promotion']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::latest()->get();

        return view('admin.ads.create', compact('categories'));
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
            'ads_image' => 'required|mimes: jpg,png,jpeg',
            'category_id' => 'required',
        ]);
        $ads = new Ads;
        $ads->created_by = Auth::user()->id;
        $ads_image = $request->ads_image;
        $ads->category_id = $request->category_id;
        $ads->status = $request->status;

        if($ads_image){
            $image_one_name= hexdec(uniqid()).'.'.$ads_image->getClientOriginalExtension();
            $path = public_path('/promotion/');
            Image::make($ads_image)->resize(300,300)->save($path.$image_one_name);
            $ads->ads_image= $image_one_name;
            $insert = $ads->save();
        }
        $notification=array(
            'messege'=>'Promotions Inserted Successfully',
            'alert-type'=>'success'
        );


        if ($insert) {
            return redirect()->route('ads.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add Promotions.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit(Ads $ads)
    {
        $promotion = Ads::where('deleted_at')->get();
        return view('admin.ads.edit')->with(compact(['ads', 'promotion']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ads $ads)
    {
        $request->validate([
            'ads_image' => 'required',
            'category_id' => 'required',
        ]);
        $ads->created_by = Auth::user()->id;
        $ads->category_id = $request->category_id;
        $ads->status = $request->status;
        $update = $ads->update($request->all());

        $old_one=$request->old_one;
        $image_one=$request->ads_image;
        $data=array();

        if($request->has('image_one')) {

            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/promotion/'.$image_one_name);
            $data['ads_image']='public/promotion/'.$image_one_name;
            unlink($old_one);
            $insert = $ads->update($data);
        }
        $notification=array(
            'messege'=>'Promotions updated Successfully',
            'alert-type'=>'success'
        );

        if ($update) {
            return redirect()->route('ads.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to update Promotions.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ads $ads)
    {
        $ads->delete();

        $notification=array(
            'messege'=>'Promotions deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('ads.index')->with($notification);
    }
}
