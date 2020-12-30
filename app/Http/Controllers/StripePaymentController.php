<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe($proid)
    {
        $payProduct = Product::find($proid);
        return view('stripe')->with(compact('payProduct'));
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey("sk_test_8Ec85pzzbuHoNM0u1BIniXhk");
        Stripe\Charge::create ([
                "amount" => 100 * $request->payprice,
                "currency" => "INR",
                "source" => $request->stripeToken,
                "description" => $request->paydesc . " - Test payment from demopay." 
        ]);
  
        Session::flash('success', 'Payment successful!');
          
        return back();
    }
}
