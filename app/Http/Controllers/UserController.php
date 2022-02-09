<?php

namespace App\Http\Controllers;

use App\CPU\ImageManager;
use App\Models\Customer;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    // public function index(User $model)
    // {
    //     return view('users.index');
    // }
    public function edit()
    {
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }
        $customer = auth('customer')->user();
        session()->put('page-title', 'Profil Edit');

        return view('web-views.profile.profileEdit', compact('customer'));
    }

    public function view()
    {
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }
        $data = auth('customer')->user();
        session()->put('page-title', 'Profil');

        return view('web-views.profile.profileView', compact('data'));
    }

    public function update(Request $request)
    {
        // $image = $request->file('image');
        $image = $request->file('image');
        // foreach ($img as $image) {
        // }
        // dd($request);

        if ($image != null) {
            $imageName = ImageManager::update('profile/', auth('customer')->user()->image, 'png', $request->image);
        } else {
            $imageName = auth('customer')->user()->image;
        }

        Customer::where('id', auth('customer')->id())->update([
             'image' => $imageName,
         ]);

        if ($request['password'] != null) {
            if ($request['password'] != $request['con_password']) {
                Toastr::error('Password tidak sama.');

                return back();
            }
            $fil = str_replace(',', ' ', $request->address);
            $userDetails = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $fil,
                'password' => strlen($request->password) > 3 ? bcrypt($request->password) : auth('customer')->user()->password,
            ];
        } else {
            $userDetails = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                // 'password' => strlen($request->password) > 3 ? bcrypt($request->password) : auth('customer')->user()->password,
            ];
        }

        if (auth('customer')->check()) {
            Customer::where(['id' => auth('customer')->id()])->update($userDetails);
            Toastr::info('Data berhasil di update');

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
