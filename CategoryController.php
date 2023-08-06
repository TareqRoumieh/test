<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController
{

    public function index()
    {
        $category=category::all();
        return view('admin.category',compact('category'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {

        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'image' => 'required',
        ]);
        $image=$request->file('image')->getClientOriginalName();
        $path= $request->file('image')->storeAs('categories',$image,'imges');
        category::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'image'=>$path
        ]);
        return back();
    }

    public function show(category $category)
    {
        //
    }
    public function edit(category $category)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $image=$request->file('image')->getClientOriginalName();
        $path= $request->file('image')->storeAs('categories',$image,'imges');
        
        if($request->file('image') == null){
            $request->image ==$path;
        }else{
            $request->image == '';
        }

        if($request->file('name_ar') == null){
            $request->image == 'name_ar';
        }else{
            $request->name_ar == '';
        }

        if($request->file('name_en') == null){
            $request->image == 'name_en';
        }else{
            $request->name_en == '';
        }

        {
            $request->validate([
                'name_ar' => 'nullable',
                'name_en' => 'nullable',
                'image' => 'nullable',
            ]);
            category::where('id',$id)->update([
                'name_ar' => $request->name_ar,
                'name_en'=>$request->name_en,
                'image'=>$path
            ]);
            return back();
        }
    }

    public function destroy($id)
    {
        category::where('id',$id)->delete();
        return back();
    }
}