<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use Illuminate\Support\Facades\Auth;

class cartcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cart= cart::select('product_id', cart::raw('sum(quantity) as quantity'))->where('user_id',Auth::user()->id)->groupBy('product_id')->get();
        return view('cart',compact('cart'));
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
    public function store(Request $request,string $id)
    {
        //
       

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

    public function addmoretocart(string $id)
    {
        //
        $cart_item = cart::select('quantity')->where('user_id',Auth::user()->id)->where('product_id',$id)->first();
        // dd();
        $cart_item->where('user_id',Auth::user()->id)->where('product_id',$id)->take(1)->update([
            'quantity'=>$cart_item->quantity+1,
        ]);
        return redirect()->back();
    }
    public function takefromcart(string $id)
    {
        //
        $cart_item = cart::select('product_id','quantity')->where('user_id',Auth::user()->id)->where('product_id',$id)->first();
        // dd($cart_item[0]->quantity);
        if($cart_item->quantity==1){
            $cart_item->where('user_id',Auth::user()->id)->where('product_id',$id)->take(1)->delete();
        }
        else{
            $cart_item->where('user_id',Auth::user()->id)->where('product_id',$id)->take(1)->update([
            'quantity'=>$cart_item->quantity-1,
        ]);  
        }
        
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $cart=cart::create([
            'user_id'=>Auth::user()->id,
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cartitem=cart::where('product_id',$id)->where('user_id',Auth::user()->id);
        $cartitem->delete();
        return redirect()->back();
    }
}
