<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $numb = strval((int) $request['phone']);
        $admin = Admin::where('email', $request->email)->orWhere('phone', $request->phone)->first();
        if (isset($admin)) {
            Toastr::warning('Email or phone already exist');

            return redirect()->back();
        }

        $request->validate([
            'name' => 'required',
            'phone' => 'unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|same:c_password',
        ]);

        $admin = Admin::create([
            'name' => $request['name'],
            'phone' => $numb,
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        Toastr::success('Admin sukses ditambahkan');

        return redirect()->back();
    }

    public function addCustomer(Request $request)
    {
        // dd($request);
        $numb = strval((int) $request['phone']);
        $admin = Customer::where('phone', $request->phone)->first();
        // dd(isset($admin));
        if (isset($admin) == true) {
            Toastr::warning('No handphone sudah ada');

            return redirect()->back();
        }

        $request->validate([
            'name' => 'required',
            'phone' => 'unique:admins',
            'address' => 'required',
            // 'email' => 'required|email|unique:admins',
            // 'password' => 'required|min:4|same:c_password',
        ]);
        $fil = str_replace(',', ' ', $request['address']);
        $admin = Customer::create([
            'name' => $request['name'],
            'phone' => $request->phone,
            'image' => 'profile.png',
            'birth_date' => $request['birthdate'],
            'address' => $fil,
            'password' => bcrypt('5758'),
        ]);

        Toastr::success('Pasien berhasil ditambahkan');

        return redirect()->back();
    }

    public function editCustomer(Request $request)
    {
        // dd($request);
        $fil = str_replace(',', ' ', $request['address']);
        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'address' => $fil,
            'birth_date' => $request['birth'],
        ];
        if (auth('admin')->check()) {
            Customer::where(['id' => $request['id']])->update($data);
            Toastr::info('Data berhasil diubah');

            return redirect()->back();
        } else {
            Toastr::error('Gagal mengubah data');

            return redirect()->back();
        }
    }
}
