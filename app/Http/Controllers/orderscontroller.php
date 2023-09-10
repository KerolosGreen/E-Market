<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\order;
use App\Models\orderitem;

class orderscontroller extends Controller
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
        if($request->payby==1 && $request->payment_id==null){
            return redirect()->back()->withErrors(['msg' => 'You Should Add Payment Method In Case You Want To Pay By Visa']);
        }
        if($request->addressid==null){
            return redirect()->back()->withErrors(['msg' => 'You Should Add Billing Address']);
        }
        if($request->payby==1)
        {
            $paymentid=$request->payment_id;
        }
        else{
            $paymentid=null;
        }
        
        $order = order::create([
            'user_id'=> 1,
            'payment_id'=>$paymentid,
            'address_id'=>$request->addressid
        ]);

        // print_r($order->id);

        $cart = cart::select('product_id','quantity')->where('user_id',1)->groupBy('product_id')->get();

        foreach($cart as $cart){
            orderitem::create([
                'order_id'=>$order->id,
                'product_id'=>$cart->product_id,
                'quantity'=>$cart->quantity    
            ]);

            $deletecart= cart::where('user_id',1)->get();
            foreach($deletecart as $dcart){
                $dcart->where('user_id',1)->delete();
            }
        }
        return redirect()->route('home');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
