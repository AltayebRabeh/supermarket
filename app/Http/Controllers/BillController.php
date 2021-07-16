<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Pay;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    public function index()
    {
        if (Auth()->user()->permission != 'مدير' && Auth()->user()->permission != 'مشرف فواتير') {
            return redirect()->route('dashboard');
        }
        $bills = Bill::whereState(0)->select()->paginate(10);
        return view('bills.index', compact('bills'));
    }

    public function done()
    {
        if (Auth()->user()->permission != 'مدير' && Auth()->user()->permission != 'مشرف طلبيات') {
            return redirect()->route('dashboard');
        }
        $bills = Bill::whereState(1)->select()->paginate(10);
        return view('bills.done', compact('bills'));
    }

    public function billDetails($id)
    {
        $bill = Bill::whereId($id)->with('sales')->first();
        return view('bills.bill', compact('bill'));
    }

    public function change($id)
    {
        Bill::whereId($id)->update(['state' => 1]);
        return redirect()->route('bills');
    }

    public function pay(Request $request)
    {
        if (!session()->has('cart')) {
            return redirect()->route('cart')->with([
                'message' => 'العربة فارغة ',
                'alert-type' => 'danger'
            ]);
        }

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

        $pay = Pay::whereAcountNumber($request->card_number)->first();
        if (! $pay){
            return redirect()->route('cart')->with([
                'message' => 'الرجاء مراجعة بيانات البطاقة ',
                'alert-type' => 'danger'
                ]);
        } else {
            if(!password_verify($request->password, $pay->password)) {
               return redirect()->route('cart')->with([
                'message' => 'الرجاء مراجعة بيانات البطاقة ',
                'alert-type' => 'danger'
                ]);
            }
        }

        if ($pay->money < $request->total) {
            return redirect()->route('cart')->with([
               'message' => 'رصيدك غير كافي',
               'alert-type' => 'danger'
            ]);
        }

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address1 . ' ,' . $request->address2 . ' ,' . $request->address3;
        try {
            DB::beginTransaction();

            $bill = Bill::create($data);

            foreach(session()->get('cart') as $key => $item) {
                $bill->sales()->create(['qty' => $item['qty'], 'price' => $item['price'], 'product_id' => $key]);
                $product = Product::find($key);
                $product->update(['qty' => $product->qty - $item['qty']]);
            }

            $supermarket = Pay::whereAcountNumber('5574693154879688')->first();

            $supermarket->update(['money' => $supermarket->money + $request->total]);
            $pay->update(['money' => $pay->money - $request->total]);

            DB::commit();
            
            session()->flash('cart');
            
            return redirect()->route('bill', $bill->id)->with([
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

    public function bill($id)
    {
        $bill = Bill::whereId($id)->with('sales')->first();
        return view('bill', compact('bill'));
    }
}