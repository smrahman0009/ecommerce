<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Charge;
use Gloudemans\Shoppingcart\Cart as ShoppingcartCart;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;

class ShoppingController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::find($request->product_id);

        $cart = Cart::add(
            [
                'id' => $request->product_id,
                'name' =>$product->name,
                'qty' => $request->qty,
                'price' => $product->price,
            ]
        );
        // dd(Cart::content());

        $cart->associate('App\Product');

        return redirect(route('cart.view'));
    }
    public function quickAddToCart($id){
        $product = Product::find($id);

        $cart = Cart::add(
            [
                'id' => $id,
                'name' =>$product->name,
                'qty' => 1,
                'price' => $product->price,
            ]
        );
        // dd(Cart::content());

        $cart->associate('App\Product');

        return redirect(route('cart.view'));
    }

    public function viewCart(){
        // Cart::destroy();
        return view('cart');
    }

    public function removeItem($rowId){
        Cart::remove($rowId);
        return redirect(route('cart.view'));
    }
    public function increment($rowId,$quantity){
        Cart::update($rowId,$quantity+1);

        return redirect()->back();
    }
    public function decrement($rowId,$quantity){
        Cart::update($rowId,$quantity-1);

        return redirect(route('cart.view'));
    }

    public function cartCheckout(){
        return view('checkout');
    }

    public function pay(Request $request){
        // dd($request->all());

        Stripe::setApiKey('sk_test_51HP6rhGvCJcmORwGuj3nHXJIaEdyuITmW51kgSgB55sgLPfZ1Ips2aSmxA6TQBa6VgeRgLdZcfQla1IAFDEre4Eg005Ud1gPSM');

        $token = $request->stripeToken;
        $intent = Charge::create([
        'amount' => 1099,
        'currency' => 'usd',
        'source' => $token,
        ]);
    }
}
