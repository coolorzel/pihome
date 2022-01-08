<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index ()
    {
        $featured_category = Category::where('status', '0')->get();
        $featured_products = Product::where('trending', '1')->take(15)->get();
        return view('shop.index', compact('featured_products', 'featured_category'));
    }
    public function category()
    {
        $featured_category = Category::where('status', '0')->get();
        return view('shop.inc.category', compact('featured_category'));
    }
    public function viewcategory($slug)
    {
        if(Category::where('slug', $slug)->exists())
        {
            $featured_category = Category::where('status', '0')->get();
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cat_id', $category->id)->where('status', '0')->get();
            return view('shop.inc.view-category', compact('featured_category', 'category', 'products'));
        }
        else{
            return redirect('shop/category')->with('status',"Dont exists category!");
        }
    }
    public function viewproduct($cat_slug, $prod_slug)
    {
        if(Category::where('slug', $cat_slug)->exists())
        {
            if(Product::where('slug', $prod_slug)->exists())
            {
                $featured_category = Category::where('status', '0')->get();
                $products = Product::where('slug', $prod_slug)->first();
                return view('shop.products.product', compact('featured_category', 'products'));
            }
            else
            {
                return redirect('/shop')->with('status', "The link was broken");
            }
        }
        else
        {
            return redirect('/shop')->with('status', "The link was broken");
        }
    }
}
