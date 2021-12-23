<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Auth;

class UnitController extends Controller
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
        $unit = Unit::where('deleted_at')->OrderBy('id', 'DESC')->get();
        return view('admin.unit.index')->with(compact(['unit']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unit.create');
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
            'unit_name' => 'required|unique:units',
        ]);
        $units = new Unit();
        $units->unit_name = $request->unit_name;
        $units->login_id = Auth::user()->id;

        $insert = $units->save();
        $notification=array(
            'messege'=>'Unit Inserted Successfully',
            'alert-type'=>'success'
        );
        if ($insert) {
            return redirect()->route('units.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add Unit.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $units = Unit::where('deleted_at')->get();
        return view('admin.unit.edit')->with(compact(['unit', 'units']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'unit_name' => 'required',
        ]);
        $unit->unit_name = $request->unit_name;
        $unit->login_id = Auth::user()->id;

        $update = $unit->update($request->all());

        $notification=array(
            'messege'=>'Unit updated Successfully',
            'alert-type'=>'success'
        );

        if ($update) {
            return redirect()->route('units.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to Update Unit.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        try{
            $unit->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }
}
