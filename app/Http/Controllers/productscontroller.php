<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File; 

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use App\Models\cart;

class productscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products=product::paginate(25);
        return view('products',compact('products'));
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
        $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $filename);
        product::create(
            [
                'name'=>$request->name,
                'price'=>$request->price,
                'brand'=>$request->brand,
                'image'=>$filename,
                'category_id'=>$request->category_id,
                'description'=>$request->description,
                'onsale'=>$request->has('onsale'),
                'quantity'=>$request->quantity
            ]
        );
        return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cart=null;
        if(Auth::check()){
            $cart= cart::where('user_id',optional(Auth::user())->id)->get();
         }
        $product = product::find($id);
        if($product){
           $similars = product::where('category_id',$product->category_id)->where('id','!=',$product->id)->take(5)->get(); 
        }
        return view('product',compact('product','similars','cart'));
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
        //
        $product = product::find($id);
        if(filesize($request->file('image'))==false){
            $filename=$product['image'];
        }
        else{
        File::delete(public_path('images/'.$product->image)); 
        $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $filename);
        }
        $product->update(
            [
                'name'=>$request->name,
                'price'=>$request->price,
                'brand'=>$request->brand,
                'image'=>$filename,
                'category_id'=>$request->category_id,
                'description'=>$request->description,
                'onsale'=>$request->has('onsale'),
                'quantity'=>$request->quantity
            ]
        );
        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = product::find($id);
           File::delete(public_path('images/'.$product->image)); 
        $product->delete();
        return redirect()->route('admin.products');
    }
    public function search(Request $request){
        $req=$request->search;
        $products=product::where('name','like','%'.$request->search.'%')->paginate(25);
        return view('products',compact('products','req'));
    }
}
