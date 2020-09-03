<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontEndController extends Controller
{
    public function index(){
        $products = Product::paginate(9);
        return view('index')->with('products',$products);
    }

    public function product($id){
        $product = Product::find($id);
        return view('product')->with('product',$product);
    }
}
