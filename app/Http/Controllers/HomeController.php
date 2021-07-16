<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('qty', '>', 0)->with(['category'])->take(4)->get();
        return view('index', compact('products'));
    }

    public function search(Request $request)
    {
        $products = Product::where('qty', '>', 0)
                            ->with('category')
                            ->where('name', 'like', '%' . $request->search . '%')
                            ->paginate(16);
        $search = $request->search;
        return view('search', compact('products', 'search'));
    }

    public function shop(Request $request)
    {
        if ($request->has('cat_id')) {
            $products = Product::where('qty', '>', 0)->whereCategoryId($request->cat_id)->with(['category'])->paginate(16);
        } else {
            $products = Product::where('qty', '>', 0)->with(['category'])->paginate(16);
        }

        $categories = Category::select()->take(6)->get();
        return view('shop', compact('products', 'categories'));
    }

    private $cart;

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        if(session()->has('cart')) {
            $this->cart = session()->get('cart');
            // dd(session()->get('cart'));
        }
        if ($product) {
            if ($product->qty >= $request->qty) {
                if (isset($this->cart[$product->id])) {
                    if ($this->cart[$product->id]['qty'] + $request->qty <= $product->qty) {
                        $request->session()->put('cart.' . $product->id, [
                            'name' => $product->name,
                            'qty' => $this->cart[$product->id]['qty'] += $request->qty,
                            'price' => $product->price,
                            'total' => $this->cart[$product->id]['qty'] * $product->price
                        ]);
                    } else {
                        return false;
                    }
                } else {
                    $this->cart[$product->id] = ['name' => $product->name, 'qty' => $request->qty, 'price' => $product->price, 'total' => $product->price * $request->qty];
                    session()->put('cart', $this->cart);
                }
            } else {
                return false;
            }
        }
    }

    public function cart()
    {
        $items = session()->get('cart');
        return view('cart', compact('items'));
    }

    public function cartCount()
    {
        return session()->exists('cart') ? count(session()->get('cart')) : 0;
    }

    public function cartDelete($id)
    {
        session()->flash('cart.'. $id);
        return redirect()->route('cart-delete-back');
    }

    public function cartDeleteBack()
    {
        return redirect()->route('cart');
    }
}