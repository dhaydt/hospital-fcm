<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Checkup;
use App\Models\Content;
use App\Models\Customer;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function checkup(Request $request)
    {
        // dd($request);
        $user = Customer::where('phone', $request['phone'])->first();
        // $user = Customer::where('phone', $request['phone'])->first();
        if (!$user) {
            $respon = 'pasien tidak ditemukan';

            return response()->json($respon, 200);
        }
        $check = Checkup::with('customer')->where('pasien_id', $user->id)->orderby('created_at', 'DESC')->first();
        if (!$check) {
            $respon = 'belum ada data pemeriksaan';

            return response()->json($respon, 200);
        }
        $name = $check->customer->name;
        $datang = date('d-m-Y', strtotime($check->datang));
        $kembali = date('d-m-Y', strtotime($check->kembali));
        $respon = $name.', '.$datang.', '.$kembali;
        // dd($respon);

        return $respon;
    }

    public function profile(Request $request)
    {
        $user = Customer::where('phone', $request['phone'])->first();
        // $user = Customer::where('phone', $request['phone'])->first();
        // $check = Checkup::with('customer')->where('pasien_id', $user)->orderby('created_at', 'DESC')->first();
        if (!$user) {
            $respon = 'belum ada data';

            return response()->json($respon, 200);
        }
        $name = $user->name;
        $lahir = date('d-m-Y', strtotime($user->birth_date));
        $address = $user->address;
        $phone = $user->phone;
        $respon = $name.', '.$lahir.', '.$address.', '.$phone;
        // dd($respon);

        return $respon;
    }

    public function categoryCheckup(Request $request)
    {
        $user = Customer::where('phone', $request['phone'])->first();
        $check = Checkup::where(['pasien_id' => $user->id, 'cat_id' => $request['cat_id']])->latest('datang')->first();
        $layanan = $check->category;
        $nama = $user->name;
        $datang = date('d-m-Y', strtotime($check->datang));
        if ($check->kembali) {
            $kembali = date('d-m-Y', strtotime($check->kembali));
        } else {
            $kembali = '-';
        }
        $resp = $layanan.', '.$nama.', '.$datang.', '.$kembali;

        return $resp;
        // dd($resp);
    }

    public function content(Request $request)
    {
        // dd($request);
        if ($request['category']) {
            $data = Content::where('cat_id', $request['category'])->orderby('id', 'DESC')->get();
        } else {
            $data = Content::orderby('id', 'DESC')->get();
        }
        function append_string($inc, $kontent)
        {
            $inc .= $kontent;

            // Returning the result
            return $inc;
        }
        $inc = '';
        foreach ($data as $d) {
            $img = env('APP_URL').'storage/content/'.$d->image;
            $title = $d->title;
            $create = $d->created_at;
            $createby = 'Admin';
            $desc = $d->description;
            $kontent = $img.' | '.$title.' | '.$create.' | '.$createby.' | '.$desc.', ';
            $inc = append_string($inc, $kontent);
        }
        // dd($inc);

        return $inc;
    }
}
