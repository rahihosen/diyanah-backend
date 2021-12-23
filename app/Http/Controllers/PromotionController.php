<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Image;

class PromotionController extends Controller
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
        $promotion = Promotion::with('Category')->where('status',1)->OrderBy('id', 'DESC')->get();


        return view('admin.promotion.index',compact('promotion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  Category::latest()->get();

        return view('admin.promotion.create', compact('categories'));
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
            'promotion_image' => 'required|mimes: jpg,png,jpeg',
            'category_id' => 'required',
        ]);
        $promotion = new Promotion;
        $promotion->created_by = Auth::user()->id;
        $promotion_image = $request->promotion_image;
        $promotion->category_id = $request->category_id;
        $promotion->status = $request->status;

        if($promotion_image){
            $image_name= hexdec(uniqid()).'.'.$promotion_image->getClientOriginalExtension();
            $path = public_path('/promotion/');
            Image::make($promotion_image)->resize(300,300)->save($path.$image_name);
            $promotion->promotion_image= $image_name;
            $insert = $promotion->save();
        }
        $notification=array(
            'messege'=>'Promotions Inserted Successfully',
            'alert-type'=>'success'
        );


        if ($insert) {
            return redirect()->route('promotions.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add Promotions.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        $categories = Category::get();
        return view('admin.promotion.edit')->with(compact(['promotion', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'promotion_image' => 'required',
        ]);
        $promotion->created_by = Auth::user()->id;
        $promotion->category_id = $request->category_id;
        $promotion->status = $request->status;

        $old_one=$request->old_one;
        $image_one=$request->promotion_image;

        $data=array();

        if($image_one) {

            $image_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            $path = public_path('/promotion/');
            Image::make($image_one)->resize(300,300)->save($path.$image_name);

            $promotion->promotion_image = $image_name;

            $insert = $promotion->update();

            $notification=array(
                'messege'=>'Promotions updated Successfully',
                'alert-type'=>'success'
            );

            if ($insert) {
                return redirect()->route('promotions.index')->with($notification);
            }
        }


        return redirect()->back()->with(['error' => 'Unable to update Promotions.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        try{
            $promotion->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }
}
