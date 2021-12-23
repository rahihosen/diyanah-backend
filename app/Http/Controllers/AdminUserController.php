<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Admin;
use Auth;
use Hash;
use Image;
use DB;



class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use HasRoles;
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        $roles = Role::orderBy('id','DESC')->get();

        return view('admin.admin.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required',
        ]);
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role_id = $request->role_id;
        $admin->password = Hash::make($request->password);

        $product_image = $request->profile_photo_path;

        if($product_image){
            $image_name= hexdec(uniqid()).'.'.$product_image->getClientOriginalExtension();
            $path = public_path('/admin/');
            Image::make($product_image)->resize(300,300)->save($path.$image_name);
            $admin->profile_photo_path= $image_name;
            $insert = $admin->save();
        }
       
        $notification=array(
            'messege'=>'Admin Inserted Successfully',
            'alert-type'=>'success'
        );


        if ($insert) {
            return redirect()->route('admin.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add Product']);
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
    public function edit(Admin $admin,$id)
    {
        $roles = Admin::with('roles')->FindOrFail($id);
        $role = Role::latest()->get();
        $admins = Admin::where('id',$id)->first();
        // dd($admins);
        return view('admin.admin.edit')->with(compact(['roles', 'admins','role']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $admin->name = $request->name;
        $admin->email = $request->email;
        

        $old_one=$request->old_one;
        $image_one= $request->profile_photo_path;

        
        if($image_one) {
            $image_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            $path = public_path('/admin/');
            Image::make($image_one)->resize(300,300)->save($path.$image_name);
            $admin['profile_photo_path'] = $image_name;
            $insert = $admin->update(); 
        }

        $notification=array(
            'messege'=>'admin updated Successfully',
            'alert-type'=>'success'
        );
          
        if ($insert) {
            return redirect()->route('admin.index')->with($notification);
        }
        return redirect()->back()->with(['error' => 'Unable to update Brand']);
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
            Admin::where('id',$id)->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
        
        }
    }
}
