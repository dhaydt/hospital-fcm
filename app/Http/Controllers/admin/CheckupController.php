<?php

namespace App\Http\Controllers\admin;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Checkup;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckupController extends Controller
{
    public function index(Request $request)
    {
        $pasien = Customer::get();
        $query_param = [];
        $start = $request['start-date'];
        $end = $request['end-date'];
        $search = $request['search'];
        if ($request->has('start-date')) {
            if ($start == $end) {
                $orders = Checkup::where('datang', 'like', "%{$start}%");
            } else {
                $orders = Checkup::whereBetween('datang', [$start, $end]);
            }
            // $query_param = ['start-date' => $start, 'end-date' => $end];

            // $admin = $orders->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

            // return view('admin-views.checkup.list', compact('admin', 'start', 'end', 'pasien'));
        } else {
            $orders = Checkup::with(['customer']);
        }
        $cat = category::get();

        session()->put('title', 'Checkup List');
        $admin = $orders->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

        return view('admin-views.checkup.list', compact('admin', 'start', 'end', 'pasien', 'cat'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'pasien_id' => 'required',
        'chat' => 'required',
    ], [
        'pasien_id.required' => 'Pilih satu pasien!',
        'chat.required' => 'Pilih jenis layanan!',
    ]);
        // dd($request);
        foreach ($request['chat'] as $c) {
            if ($c) {
                $name = category::where('id', $c)->first();
                $checkup = new Checkup();

                $checkup->pasien_id = $request['pasien_id'];
                $checkup->cat_id = $c;
                $checkup->datang = Carbon::now();
                $checkup->category = $name->name;
                $checkup->save();
            }
        }
        Toastr::success('Pasien berhasil di daftarkan');

        return back();
    }

    public function update(Request $request)
    {
        $pasien = Checkup::where('id', $request->id)->first();
        if ($request->next) {
            $pasien->next_service = $request->next;
        }
        $pasien->kembali = $request->kembali;
        $pasien->save();
        Toastr::success('Data kembali berhasil ditambahkan');

        return back();
    }

    public function delete($id)
    {
        // dd($id);
        $pasien = Checkup::where('id', $id)->first();
        $pasien->delete();
        Toastr::success('Data checkup berhasil dihapus');

        return back();
    }
}
