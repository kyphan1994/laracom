<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{
    public function destroy($id) {
        Cart::instance('saveForLater')->remove($id);
        return back()->with('success', 'Item has been removed');
    }

    public function moveToCart($id) {
        
        $item = Cart::instance("saveForLater")->get($id);
        Cart::instance('saveForLater')->remove($id);
        
        $duplicate = Cart::instance('default')->search(function($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if($duplicate->isNotEmpty()) {
            return redirect('/cart')->with('success',"Item is already in your cart");
        }
        
        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');
        return redirect('/cart')->with('success', 'Item was added to your cart!');
    }
}
