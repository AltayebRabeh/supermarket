<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }

    public function pay(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:10',
            'phone' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'address3' => 'required',
            'card_number' => 'required|min:16|max:16',
            'password' => 'required|min:4|max:4',
        ]);

        if($validate->fails()) {
            return redirect()->route('cart')->withErrors($validate);
        }

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address1 . ' ,' . $request->address2 . ' ,' . $request->address3;
        try {
            DB::beginTransaction();

            $bill = Bill::create($data);

            foreach(session()->get('cart') as $key => $item) {
                $bill->sales()->create(['qty' => $item['qty'], 'product_id' => $key]);
            }

            DB::commit();
            session()->flash('cart');
            return redirect()->route('index')->with([
               'message' => 'تمت العملية بنجاح',
               'alert-type' => 'success' 
            ]);
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->route('index')->with([
               'message' => 'عذراً حصل خطأ ما الرجاء المحاولة لاحقاً',
               'alert-type' => 'danger' 
            ]);
        }
    }
}