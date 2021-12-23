<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Auth;
use Image;

class FeatureController extends Controller
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
        $feature = Feature::where('deleted_at')->OrderBy('id', 'DESC')->get();


        return view('admin.feature.index',compact('feature'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feature.create');
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
            'feature_image' => 'required|mimes: jpg,png,jpeg',
            'feature_title' => 'required',
            'feature_description' => 'required',
        ]);
        $feature = new Feature;
        $feature->created_by = Auth::user()->id;
        $feature_image = $request->feature_image;
        $feature->feature_title = $request->feature_title;
        $feature->feature_description = $request->feature_description;

        if($feature_image){
            $image_name= hexdec(uniqid()).'.'.$feature_image->getClientOriginalExtension();
            $path = public_path('/feature/');
            Image::make($feature_image)->resize(300,300)->save($path.$image_name);
            $feature->feature_image= $image_name;
            $insert = $feature->save();
        }
        $notification=array(
            'messege'=>'Feature Inserted Successfully',
            'alert-type'=>'success'
        );


        if ($insert) {
            return redirect()->route('features.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add features.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        return view('admin.feature.edit')->with(compact(['feature']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'feature_image' => 'required|mimes: jpg,png,jpeg',
            'feature_title' => 'required',
            'feature_description' => 'required',
        ]);
        $feature->created_by = Auth::user()->id;
        $feature->feature_title = $request->feature_title;
        $feature->feature_description = $request->feature_description;

        $old_one=$request->old_one;
        $image_one=$request->feature_image;


        if($image_one) {

            $image_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            $path = public_path('/feature/');
            Image::make($image_one)->resize(300,300)->save($path.$image_name);

            $feature->feature_image = $image_name;

            $insert = $feature->update();

            $notification=array(
                'messege'=>'Feature updated Successfully',
                'alert-type'=>'success'
            );
             
            if ($insert) {
                return redirect()->route('features.index')->with($notification);
            }
        }


        return redirect()->back()->with(['error' => 'Unable to update Feature']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        try{
            $feature->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }


}
