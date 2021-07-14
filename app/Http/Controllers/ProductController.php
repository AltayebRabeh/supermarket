<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category'])->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:10',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'image' => 'required|image',
            'category' => 'required',
        ]);

        if($validate->fails()) {
            return redirect()->route('products.create')->withErrors($validate);
        }

        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['qty'] = $request->qty;
        $data['category_id'] = $request->category;

        $imagePath = $request->file('image');
        $imageName = $imagePath->getClientOriginalName();

        $path = $request->file('image')->storeAs('uploads', $imageName, 'uploads');

        $data['image'] = $path;

        Product::create($data);
        return redirect()->route('products')->with([
            'message' => 'تم الحفظ بنجاح',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['category'])->find($id);
        $categories = Category::all();
        if($product) {
            return view('products.edit', compact('categories', 'product'));
        }

        return redirect()->route('products')->with([
            'message' => 'عذراً حصل خطاء بالعملية الرجاء المحاولة مرة اخرى',
            'alert-type' => 'danger'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:10',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'image' => 'image',
            'category' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->route('products.create')->withErrors($validate);
        }

        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['qty'] = $request->qty;
        $data['category_id'] = $request->category;

        if ($request->image) {
            $imagePath = $request->file('image');
            
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('image')->storeAs('uploads', $imageName, 'uploads');

            $data['image'] = $path;
        }

        $product = Product::find($id);
        if ($product) {
            $product->update($data);
            return redirect()->route('products')->with([
                'message' => 'تم الحفظ بنجاح',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('products')->with([
            'message' => 'عذراً حصل خطاء بالعملية الرجاء المحاولة مرة اخرى',
            'alert-type' => 'danger'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product) {
            // if ($product->image) {
            //     unlink(public_path($product->image));
            // }
            $product->delete();
            return redirect()->route('products')->with([
                'message' => 'تم الحذف بنجاح',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('products')->with([
            'message' => 'عذراً حصل خطاء بالعملية الرجاء المحاولة مرة اخرى',
            'alert-type' => 'danger'
        ]);
    }
}