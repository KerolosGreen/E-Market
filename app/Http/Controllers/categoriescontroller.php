<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\File; 

class categoriescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         //
         $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
         $request->file('image')->move(public_path('images'), $filename);

         category::create(
             [
                 'name'=>$request->name,
                 'image'=>$filename,
             ]
         );
         return redirect()->route('admin.categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = category::find($id);
        if(filesize($request->file('image'))==false){
            $filename=$category['image'];
        }
        else{
        $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $filename);
        }
        $category->update(
            [
                'name'=>$request->name,
                'image'=>$filename,
            ]
        );
        return redirect()->route('admin.categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category=category::find($id);
        File::delete(public_path('images/'.$category->image)); 
        $category->delete();
        return redirect()->route('admin.categories');

    }
}
