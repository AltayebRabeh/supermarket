<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->permission != 'مدير') {
            return redirect()->route('dashboard');
        }
        
        $categories = Category::select()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth()->user()->permission != 'مدير') {
            return redirect()->route('dashboard');
        }
        return view('categories.create');
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
            'name' => 'required',
            'description' => 'required',
        ]);

        if($validate->fails()) {
            return redirect()->route('categories.create')->withErrors($validate);
        }

        Category::create($request->all());
        return redirect()->route('categories')->with([
            'message' => 'تم الحفظ بنجاح',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth()->user()->permission != 'مدير') {
            return redirect()->route('dashboard');
        }

        $category = Category::find($id);
        if($category) {
            return view('categories.edit', compact('category'));
        }

        return redirect()->route('categories')->with([
            'message' => 'عذراً حصل خطاء بالعملية الرجاء المحاولة مرة اخرى',
            'alert-type' => 'danger'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        if($category) {
            $category->update($data);
            return redirect()->route('categories')->with([
                'message' => 'تم التعديل بنجاح',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('categories')->with([
            'message' => 'عذراً حصل خطاء بالعملية الرجاء المحاولة مرة اخرى',
            'alert-type' => 'danger'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category) {
            $category->delete();
            return redirect()->route('categories')->with([
                'message' => 'تم الحذف بنجاح',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('categories')->with([
            'message' => 'عذراً حصل خطاء بالعملية الرجاء المحاولة مرة اخرى',
            'alert-type' => 'danger'
        ]);
    }
}