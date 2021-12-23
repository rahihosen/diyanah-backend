<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Auth;
use Image;

class SlideController extends Controller
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
        $slide = Slide::where('deleted_at')->OrderBy('id', 'DESC')->get();

        return view('admin.slide.index',compact('slide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
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
            'slide_image' => 'required|mimes: jpg,png,jpeg',
        ]);
        $slide = new Slide;
        $slide->created_by = Auth::user()->id;
        $slide_image = $request->slide_image;

        if($slide_image){
            $image_name= hexdec(uniqid()).'.'.$slide_image->getClientOriginalExtension();
            $path = public_path('/slide/');
            Image::make($slide_image)->resize(300,300)->save($path.$image_name);
            $slide->slide_image= $image_name;
            $insert = $slide->save();
        }
        $notification=array(
            'messege'=>'Slide Inserted Successfully',
            'alert-type'=>'success'
        );


        if ($insert) {
            return redirect()->route('slides.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add Slides.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        $slides = Slide::where('deleted_at')->get();
        return view('admin.slide.edit')->with(compact(['slide', 'slides']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'slide_image' => 'required',
        ]);
        $slide->created_by = Auth::user()->id;

        $old_one=$request->old_one;
        $image_one=$request->slide_image;

        $data=array();

        if($image_one) {

            $image_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            $path = public_path('/slide/');
            Image::make($image_one)->resize(300,300)->save($path.$image_name);

            $slide->slide_image = $image_name;

            $insert = $slide->update();

            $notification=array(
                'messege'=>'Slide updated Successfully',
                'alert-type'=>'success'
            );

            if ($insert) {
                return redirect()->route('slides.index')->with($notification);
            }
        }


        return redirect()->back()->with(['error' => 'Unable to update Slide.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        try{
            $slide->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }
}
