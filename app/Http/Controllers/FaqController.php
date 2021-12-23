<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Auth;

class FaqController extends Controller
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
        $faqs = Faq::where('deleted_at')->OrderBy('id', 'DESC')->get();
        return view('admin.faq.index')->with(compact(['faqs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faqs = Faq::all();

        return view('admin.faq.create', compact('faqs'));
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
            'faq_question' => 'required',
            'faq_answer' => 'required',
        ]);
        $faq = new Faq;
        $faq->login_id = Auth::user()->id;
        $faq->faq_question = $request->faq_question;
        $faq->faq_answer = $request->faq_answer;

        $insert = $faq->save();
        $notification=array(
            'messege'=>'Faq Inserted Successfully',
            'alert-type'=>'success'
        );

        if ($insert) {
            return redirect()->route('faqs.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add Faq.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $faqs = Faq::get();
        return view('admin.faq.edit')->with(compact(['faq', 'faqs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'faq_question' => 'required',
            'faq_answer' => 'required',
        ]);
        $faq->faq_question = $request->faq_question;
        $faq->faq_answer = $request->faq_answer;
        $update = $faq->update($request->all());

        $notification=array(
            'messege'=>'Faq updated Successfully',
            'alert-type'=>'success'
        );

        if ($update) {
            return redirect()->route('faqs.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to update Faq.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        try{
            $faq->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }
}
