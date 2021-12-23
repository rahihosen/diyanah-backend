<?php

namespace App\Http\Controllers;

use App\Models\Offer_detail;
use Illuminate\Http\Request;

use App\Models\Offer;
use App\Models\Product;
use Auth;
use DB;

class OfferDetailController extends Controller
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
        $offer_details = Offer_detail::with('product')->with('offer')->orderBy('id', 'DESC')->get();

        return view('admin.set_offer.index')->with(compact(['offer_details']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('deleted_at')->orderBy('id','DESC')->get();
        $offers = Offer::where('deleted_at')->orderBy('id','DESC')->get();
        return view('admin.set_offer.create', compact('products', 'offers'));
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
            'product_id' => 'required',
            'offer_id' => 'required',
        ]);
        $offer_details = new Offer_detail();
        $offer_details->login_id = Auth::user()->id;
        $offer_details->product_id = $request->product_id;
        $offer_details->offer_id = $request->offer_id;

        $insert = $offer_details->save();
        $notification=array(
            'messege'=>'Offer Set Successfully',
            'alert-type'=>'success'
        );

        if ($insert) {
            return redirect()->route('SetOffers.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to set Offer.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer_detail  $offer_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Offer_detail $offer_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer_detail  $offer_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer_detail $offer_detail, $id)
    {

        $products = Product::where('deleted_at')->get();
        $offers = Offer::where('deleted_at')->get();
        $offer_details = Offer_detail::where('id', $id)->first();

        return view('admin.set_offer.edit')->with(compact(['offer_detail', 'offer_details', 'products','offers']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer_detail  $offer_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer_detail $offer_detail, $id)
    {
        $offer_detail = array();
        $offer_detail['login_id'] = Auth::user()->id;
        $offer_detail['product_id'] = $request->product_id;
        $offer_detail['offer_id'] = $request->offer_id;
        $update = DB::table('offer_details')->where('id', $id)->update($offer_detail);
//        $update = $offer_detail->update($request->all());

        $notification=array(
            'messege'=>'Offer Updated Successfully',
            'alert-type'=>'success'
        );

        if ($update) {
            return redirect()->route('SetOffers.index')->with($notification);
        }

        return redirect()->back()->with(['warning' => 'Unable to Update Offer.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer_detail  $offer_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer_detail $offer_detail, $id)
    {
            try{
                DB::table('offer_details')->where('id',$id)->delete();
                return response()->json(['success' => true]);
                
            }catch(QueryException $e){
                return response()->json(['success' => false]);
            
            }
    }



}
