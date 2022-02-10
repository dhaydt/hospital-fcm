<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Checkup;
use App\Models\Content;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $user = auth('customer')->id();
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }

        $blog = Content::orderBy('id', 'DESC')->get();
        $cat = category::orderBy('id', 'ASC')->get();

        session()->put('page-title', 'home');

        return view('web-views.home', compact('blog', 'cat'));
    }

    public function home2()
    {
        $blog = Content::orderBy('id', 'DESC')->get();
        $cat = category::orderBy('id', 'DESC')->get();

        session()->put('page-title', 'home');

        return view('web-views.home2', compact('blog', 'cat'));
    }

    public function getKembali()
    {
        $user = auth('customer')->id();
        $date = Carbon::now()->format('Y-m-d');
        $check = Checkup::where(['pasien_id' => $user, 'kembali' => $date])->get();
        dd($check, $date);
    }

    public function content($id)
    {
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }
        $blog = Content::where('id', $id)->first();
        session()->put('page-title', 'Edukasi');

        return view('web-views.content', compact('blog'));
    }

    public function content2($id)
    {
        $blog = Content::where('id', $id)->first();
        session()->put('page-title', 'Edukasi');

        return view('web-views.content', compact('blog'));
    }

    public function checkup()
    {
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }
        $id = auth('customer')->user()->id;
        $data = Checkup::with('customer')->latest('created_at')->where('pasien_id', $id)->get();
        // dd($data);
        session()->put('page-title', 'Pemeriksaan');
        $konten = [];

        return view('web-views.checkup', compact('data', 'konten'));
    }

    public function checkupSingle($id)
    {
        if (auth('customer')->user() == null) {
            return redirect()->route(('customersLogin'));
        }
        $check = category::where('id', $id)->first();
        $ids = auth('customer')->id();
        $data = Checkup::with('customer')->latest('created_at')->where(['pasien_id' => $ids, 'cat_id' => $id])->get();
        // dd($data);
        $konten = Content::where('cat_id', $id)->orderBy('created_at', 'DESC')->get();
        // dd($konten, $id);
        session()->put('page-title', $check->name);

        return view('web-views.checkup', compact('data', 'konten'));
    }

    public function checkout_complete(Request $request)
    {
        session()->put('payment', $request['payment_method']);

        $data = [
            'name' => 'Transaksi berhasil',
        ];
        session()->put('category', $data);

        return view('web-views.checkout-complete');
    }

    public function shipping()
    {
        return view('web-views.shipping');
    }

    public function saveToken(Request $request)
    {
        $id = auth('customer')->id();
        $user = Customer::where('id', $id)->first();

        $user->device_token = $request->token;
        $user->save();
        // auth('customer')->user()->save(['device_token' => $request->token]);

        return response()->json(['token saved successfully.']);
    }

    public function sendNotification(Request $request)
    {
        $firebaseToken = Customer::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAFhS4gQE:APA91bGqQ7NDoEieUd6hRvRJagJ-nnxWBp7fuh7Z1Qmz8Z7O2NRTwG2hFj-BOf3-xpYATs7RLN5aSScaLUgND1ghyjEChXqdMQFsJNS-vvu_YvIZ-_Hiuwpv6FfSazM4kdKV36Glg0p7';

        $data = [
            'registration_ids' => $firebaseToken,
            'notification' => [
                'title' => 'Bidan Ratna Dewi',
                'body' => 'Sudah waktu nya berobat',
                'content_available' => true,
                'priority' => 'high',
            ],
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key='.$SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return redirect()->back();
    }
}
