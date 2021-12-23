<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Auth;

class TagController extends Controller
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
        $tag = Tag::where('deleted_at')->OrderBy('id', 'DESC')->get();
        return view('admin.tag.index')->with(compact(['tag']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
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
            'tag_name' => 'required|unique:tags',
        ]);
        $tags = new Tag();
        $tags->tag_name = $request->tag_name;
        $tags->login_id = Auth::user()->id;

        $insert = $tags->save();
        $notification=array(
            'messege'=>'Tag Inserted Successfully',
            'alert-type'=>'success'
        );
        if ($insert) {
            return redirect()->route('tags.index')->with($notification);
        }

        return redirect()->back()->with(['error' => 'Unable to add Tag']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $tags = Tag::where('deleted_at')->get();
        return view('admin.tag.edit')->with(compact(['tag', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'tag_name' => 'required',
        ]);
        $tag->tag_name = $request->tag_name;
        $tag->login_id = Auth::user()->id;
        $update = $tag->update($request->all());
        $notification=array(
            'messege'=>'Tag updated Successfully',
            'alert-type'=>'success'
        );
        if ($update) {
            return redirect()->route('tags.index')->with($notification);
        }
        return redirect()->back()->with(['error' => 'Unable to Update Tag.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        try{
            $tag->delete();
            return response()->json(['success' => true]);
            
        }catch(QueryException $e){
            return response()->json(['success' => false]);
           
        }
    }
}
