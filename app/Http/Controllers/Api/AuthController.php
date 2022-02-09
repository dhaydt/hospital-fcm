<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $respon = 'No HP & password diperlukan';

            return response()->json($respon, 400);
        } else {
            $user = Customer::where('phone', $request['phone'])->first();

            if (!$user) {
                $respon = 'No handphone salah';

                return response()->json($respon, 400);
            }

            $credentials = request(['phone', 'password']);

            if (!auth('customer')->attempt($credentials)) {
                $respon = 'pin salah';

                return response()->json($respon, 401);
            }

            if (!\Hash::check($request['password'], $user->password, [])) {
                throw new \Exception('Pin salah');
            }

            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = 'sukses';

            return response()->json($respon, 200);
        }
    }
}
