<?php

namespace App\Http\Controllers\customers\auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }

    public function index()
    {
        return view('customers.auth.login');
    }

    public function submit(Request $request)
    {
        // dd($request);
        $request->validate([
            'phone' => 'required',
            'password' => 'required|min:4',
        ]);

        $remember = ($request['remember']) ? true : false;
        $user = Customer::where('phone', $request->phone)->first();

        // dd($user);
        if (isset($user) == false) {
            Toastr::error('No HP belum terdaftar');

            return back()->withInput();
        }

        if (isset($user) && auth('customer')->attempt(['phone' => $request->phone, 'password' => $request->password], $remember)) {
            Toastr::info('Selamat datang  '.$user->name.' di Aplikasi '.env('APP_NAME').' !');

            return redirect()->route('home');
        }
        // dd($user);

        Toastr::error('Password atau no HP salah');

        return back()->withInput();
    }

    public function logout(Request $request)
    {
        auth()->guard('customer')->logout();
        // session()->forget('wish_list');
        Toastr::info('Come back soon, '.'!');

        // session()->put('hide_banner', false);

        return redirect()->route('home');
    }
}
