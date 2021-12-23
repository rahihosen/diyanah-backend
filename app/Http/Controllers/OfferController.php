<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;

use Illuminate\Http\Request;
use Auth;

class OfferController extends Controller
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
        $offers = Offer::where('deleted_at')->get();

        return view('admin.offer.index')->with(compact(['offers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('deleted_at')->get();

        return view('admin.offer.create', compact('products'));
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
            'offer_name' => 'required',
            'offer_type' => 'required',
            'offer_amount' => 'required',
            'offer_start_date' => 'required',
            'offer_end_date' => 'required',
        ]);
        $offer = new Offer;
        $offer->login_id = Auth::user()->id;
        $offer->offer_name = $request->offer_name;
        $offer->offer_type = $request->offer_type;
        $offer->offer_amount = $request->offer_amount;
        $offer->offer_start_date = $request->offer_start_date;
        $offer->offer_end_date = $request->offer_end_date;
        $offer->status = $request->status;


        $insert = $offer->save();





        $notification=array(
            'messege'=>'Offer Inserted Successfully',
            'alert-type'=>'success'
        );

        if ($insert) {
            return redirect()->route('offers.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add Offer.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $offers = Offer::get();
        return view('admin.offer.edit')->with(compact(['offer', 'offers']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'offer_name' => 'required',
            'offer_type' => 'required',
            'offer_amount' => 'required',
            'offer_start_date' => 'required',
            'offer_end_date' => 'required',
        ]);
        $offer->offer_name = $request->offer_name;
        $offer->offer_type = $request->offer_type;
        $offer->offer_amount = $request->offer_amount;
        $offer->offer_start_date = $request->offer_start_date;
        $offer->offer_end_date = $request->offer_end_date;
        $offer->status = $request->status;
        $update = $offer->update($request->all());

        $notification=array(
            'messege'=>'Offer updated Successfully',
            'alert-type'=>'success'
        );

        if ($update) {
            return redirect()->route('offers.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to update Offer.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        try{
            $offer->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }
}
