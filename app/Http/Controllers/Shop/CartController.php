<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProductCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check())
        {
            $prod_check = Product::where('id', $product_id)->first();

            if($prod_check)
            {

                if(Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists())
                {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->update();
                    return response()->json(['status' => $prod_check->name." Alredy Added to cart"]);
                }
                else
                {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name." Added to cart"]);

                }
            }
        }
        else
        {
            return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function viewcart()
    {
        $featured_category = Category::where('status', '0')->get();
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('shop.products.cart', compact('featured_category', 'cartitems'));
    }

    public function remotecart(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Product deleted successfull."]);
            }
        }
        else
        {
            return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function updatecartitem(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if(Auth::check())
        {
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status'=> "Quantity updat successfull"]);
            }
        }
    }

    public function countcart()
    {
        $cartcount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count'=> $cartcount]);
    }

    public function orderitem(Request $request)
    {
        if (Auth::check()) {
            //$prod_id = $request->input('prod_id');
            if(Cart::where('user_id', Auth::id())->exists())
            {
                $count = Cart::where('user_id', Auth::id())->count();
                //$i = 1;
                for($i=0; $i < $count; $i++) {
                    $cartItem = Cart::where('user_id', Auth::id())->first();
                    $cartItem->delete();
                    }
                return response()->json(['status' => "Order successfully. "]);
            }
        }
        else
        {
            return response()->json(['status' => "Login to Continue"]);
        }


/*        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Product deleted successfull."]);
            }
        }
        else
        {
            return response()->json(['status' => "Login to Continue"]);
        }*/
    }
}
