<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class checkoutcontroller extends Controller
{
    //
    public function showdetails(){
        $cart = cart::select('product_id', cart::raw('sum(quantity) as quantity'))->where('user_id',Auth::user()->id)->groupBy('product_id')->get();
        if($cart->count()==0){
            return redirect()->back()->withErrors(['msg' => 'Can Not Checkout With Empty Cart!']);
        }
        $user = user::find(Auth::user()->id);
        return view('checkout',compact('cart','user'));
    }
}
