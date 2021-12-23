<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class DesignationController extends Controller
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
        $designations = Designation::where('deleted_at')->OrderBy('id', 'DESC')->get();
        return view('admin.designation.index')->with(compact(['designations']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::where('deleted_at')->get();
        return view('admin.designation.create', compact('designations'));
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
            'designation_title' => 'required|unique:designations',
        ]);
        $designations = new Designation();
        $designations->designation_title = $request->designation_title;
        $designations->parent_id = $request->parent_id ? $request->parent_id : 0;
        $designations->created_by = Auth::user()->id;

        $insert = $designations->save();

        $notification=array(
            'messege'=>'Designation Inserted Successfully',
            'alert-type'=>'success'
        );

        if($insert){
            return redirect()->route('designations.index')->with($notification);

        }
        return redirect()->back()->with(['error' => 'Unable to Add Designation']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */


    public function edit(Designation $designation)
    {
        $designations = Designation::where('deleted_at')->get();
        return view('admin.designation.edit')->with(compact(['designation', 'designations']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'designation_title' => 'required',
        ]);
        $designation->designation_title = $request->designation_title;
        $designation->parent_id = $request->parent_id ? $request->parent_id : 0;
        $designation->created_by = Auth::user()->id;
        $update = $designation->update($request->all());

        $notification=array(
            'messege'=>'Designation updated Successfully',
            'alert-type'=>'success'
        );

        if ($update) {
            return redirect()->route('designations.index')->with($notification);

        }
        return redirect()->back()->with(['error' => 'Unable to Update Designation']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        
        
    }
}
