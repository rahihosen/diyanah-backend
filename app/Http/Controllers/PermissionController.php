<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::latest()->get(); 
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request,
                [
                    'name' => 'required|unique:roles,name',
                    'permission' => 'array|required',
                ]
            );
            $userRole = Role::create(['name'=>$request->name]);
            $userRole->syncPermissions([$request->permission]);
            return redirect()->route('roles.index')->with('success', 'Data has been inserted successfully');
        }catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::where('id', $id)->first();
        return view('admin.permissions.edit', compact('permission'));
    }


   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Permission $permission)
    {
        try{
            $this->validate($request,['name' => 'required|unique:permissions,name']);
            $permission->update($request->all());
            return redirect()->route('permissions.index')->with('message', 'Data has been inserted successfully');
        }catch(QueryException $e){
            return redirect()->route('permissions.create')->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::table('permissions')->where('id',$id)->delete();
            return response()->json(['success' => true]);     
        }catch(QueryException $e){
            return response()->json(['success' => false]);
        }
    }


    
}
