<?php

namespace App\Http\Controllers\admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            // dd($request);
            $key = explode(' ', $request['search']);
            $admin = category::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
            $admin = $admin->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

            return view('admin-views.category.list', compact('admin', 'search'));
        } else {
            $admin = category::get();
        }

        session()->put('title', 'Kategori');
        // dd(count($admin) > 0);
        if (count($admin) > 0) {
            $admin = $admin->last()->paginate(Helpers::pagination_limit())->appends($query_param);

            // return view('admin-views.category.list', compact('admin', 'search'));
        }

        return view('admin-views.category.list', compact('admin', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'desc' => 'required',
        ], [
            'name.required' => 'Anda lupa mengisi nama kategori!',
            // 'desc.required' => 'Description Content is required!',
        ]);
        $checkup = new category();

        $checkup->name = $request['name'];
        $checkup->image = ImageManager::upload('category/', 'png', $request->file('image'));

        $checkup->save();
        Toastr::success('Kategori berhasil ditambahkan');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $pasien = category::where('id', $request->id)->first();
        $pasien->name = $request->name;
        if ($request->file('image')) {
            $pasien->image = ImageManager::update('category/', $pasien->image, 'png', $request->file('image'));
        }
        $pasien->save();
        Toastr::success('Kategori berhasil diubah');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $pasien = category::where('id', $id)->first();
        ImageManager::delete('/category'.'/'.$pasien->image);
        $pasien->delete();

        Toastr::success('Kategori berhasil dihapus');

        return back();
    }
}
