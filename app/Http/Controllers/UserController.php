<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{   
    public function index()
    {
        if (Auth()->user()->permission != 'مدير') {
            return redirect()->route('dashboard');
        }
        $users = User::select()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        if (Auth()->user()->permission != 'مدير') {
            return redirect()->route('dashboard');
        }
        $user = User::find($id);
        if ($user) {
            return view('users.edit', compact('user'));
        }
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'permission' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->route('user.edit', $id)->withErrors($validate)->withInput();
        }

        $user = User::find($id);

        if ($user) {
            $user->update(
                $request->all()
            );
            return redirect()->route('user.edit', $id)->with([
                'message' => 'تم تعديل المستخدم بنجاح',
                'alert-type' => 'success'
            ]);
        }
    }
        
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('users', $id)->with([
                'message' => 'تم حذف المستخدم بنجاح',
                'alert-type' => 'success'
            ]);
        }
    }

}