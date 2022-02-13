<?php

namespace App\Http\Controllers\admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Content;
use App\Models\Video;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        // $pasien = Customer::get();
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $admin = Content::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('title', 'like', "%{$value}%")
                            ->orWhere('content', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $admin = Content::with('category')->get();
        }
        $last = $admin->last();
        if (isset($last)) {
            $admin = $admin->last()->paginate(Helpers::pagination_limit())->appends($query_param);
        }
        session()->put('title', 'Konten List');
        $cat = category::get();

        return view('admin-views.content.list', compact('admin', 'search', 'cat'));
    }

    public function add()
    {
        $cat = category::get();

        return view('admin-views.content.addNew', compact('cat'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required',
            'category' => 'required',
        ], [
            'title.required' => 'Mohon isi judul konten',
            'category.required' => 'Mohon isi kategori konten!',
        ]);
        $checkup = new Content();

        $checkup->title = $request['title'];
        $checkup->cat_id = $request['category'];
        $checkup->description = $request->description;
        $checkup->image = ImageManager::upload('content/', 'png', $request->file('image'));

        $checkup->save();
        Toastr::success('Konten berhasil ditambahkan');

        return back();
    }

    public function update(Request $request)
    {
        // dd($request);
        $pasien = Content::where('id', $request->id)->first();
        $pasien->title = $request->title;
        $pasien->cat_id = $request->category;
        $pasien->description = $request->description;
        if ($request->file('image')) {
            $pasien->image = ImageManager::update('content/', $pasien->image, 'png', $request->file('image'));
        }
        $pasien->save();
        Toastr::success('Data konten berhasil diupdate');

        return back();
    }

    public function delete($id)
    {
        // dd($id);
        $pasien = Content::where('id', $id)->first();
        ImageManager::delete('/content/'.$pasien->image);
        $pasien->delete();
        Toastr::success('Konten berhasil dihapus');

        return back();
    }

    // Video
    public function videoList(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $admin = Video::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('title', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $admin = Video::with('category')->get();
        }
        $last = $admin->last();
        if (isset($last)) {
            $admin = $admin->last()->paginate(Helpers::pagination_limit())->appends($query_param);
        }
        session()->put('title', 'Konten Video');
        $cat = category::get();

        return view('admin-views.video.list', compact('admin', 'search', 'cat'));
    }

    public function videoAdd()
    {
        $cat = category::get();

        return view('admin-views.video.addNew', compact('cat'));
    }

    public function videoStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'urlSave' => 'required',
        ], [
            'title.required' => 'Mohon isi judul video',
            'category.required' => 'Mohon isi kategori video!',
            'urlSave.required' => 'Mohon isi Link video!',
        ]);
        // dd($request);
        $checkup = new Video();

        $checkup->title = $request['title'];
        $checkup->cat_id = $request['category'];
        $checkup->url = $request['urlSave'];
        // $checkup->image = ImageManager::upload('content/', 'png', $request->file('image'));

        $checkup->save();
        Toastr::success('Video Konten berhasil ditambahkan');

        return back();
    }

    public function videoUpdate(Request $request)
    {
        // dd($request);
        $replace = str_replace('watch?v=', 'embed/', $request->ytUrl);
        $pasien = Video::where('id', $request->id)->first();
        $pasien->title = $request->title;
        $pasien->cat_id = $request->category;
        $pasien->url = $replace;
        $pasien->save();
        Toastr::success('Video konten berhasil diupdate');

        return back();
    }

    public function videoDelete($id)
    {
        // dd($id);
        $pasien = Video::where('id', $id)->first();
        $pasien->delete();
        Toastr::success('Video Konten berhasil dihapus');

        return back();
    }
}
