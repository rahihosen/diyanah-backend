<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use DB;
use Spatie\Permission\Traits\HasRoles;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use HasRoles;
  

    public function index()
    {
        // $roles = Role::orderBy('id','DESC')->paginate(5);
        // return view('roles.index',compact('roles'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
        $roles = Role::with('permissions')->orderBy('name', 'ASC')->paginate();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        $notification=array(
            'messege'=>'Role Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('roles.index')->with($notification);
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
    // public function edit($id)
    // {
    //     $roles = Role::where('id', $id)->first();
    //     $permission = Permission::orderBy('name')->get();
    //     return view('admin.roles.edit', compact('roles','permission'));
    // }


    public function edit(Role $role){
        $permission = Permission::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', compact('role','permission','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

  public function update(Request $request, Role $role)
    {
        try{
            $this->validate($request,
                [
                    'name' => 'required',
                    'permission' => 'required',
                ]
            );

            $role->update(['name'=>$request->name]);
            $role->syncPermissions($request->permission);
            return redirect()->route('roles.index')->with('success', 'Data has been inserted successfully');
        }catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
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
            DB::table('roles')->where('id',$id)->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
        
        }
    }
}
