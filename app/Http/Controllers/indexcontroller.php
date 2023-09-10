<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cart;
use App\Models\category;
use App\Models\banner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class indexcontroller extends Controller
{
    public function index()
    {
        $products=product::paginate(5);
        $categories=category::get()->take(3);
        $cart= cart::where('user_id',optional(Auth::user())->id)->get();
        $banner=banner::get()->last();
        return view('index',compact('products','categories','cart','banner'));
    }


    public function setbanner(Request $request){
        $banner=banner::get()->last();
        if(filesize($request->file('image'))==false){
            if($banner==null){
                banner::create([
                    'image'=> $request->image
                ]);
            }
             $filename = $banner->image;   
        }
        else{
            File::delete(public_path('images/'.$banner->image)); 
        $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $filename);
        }
        
        $banner->update([
            'image'=> $filename
        ]);
        return redirect()->back();
    }
    //
}
