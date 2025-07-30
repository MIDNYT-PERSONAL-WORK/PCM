<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    public function show($id)
{
    
    $product = Product::with([ 'vendor'])->findOrFail($id);
    $venderDetails=User::where('id', $product->vendor_id)->first();
    // dd($product);
    $relatedProducts = Product::where('category_id', $product->category_id)
                            ->where('id', '!=', $product->id)
                            ->limit(4)
                            ->get();
   //dd($relatedProducts, $product);
                            // dd($product);
    return view('guest.infoPage', compact('product', 'relatedProducts', 'venderDetails'));
}






}
