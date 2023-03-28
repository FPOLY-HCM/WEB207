<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => __('Thông tin đăng nhập không chính xác'),
            ], 401);
        }

        return response()->json([
            'message' => __('Đăng nhập thành công'),
        ]);
    }
}
