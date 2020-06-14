<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\SessionUser;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // jsonwebtoken
    public function index(Request $request)
    {
        // code php
        // $headers = apache_request_headers();
        // $token = $headers['token'];
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if ( empty($token)) {
            return response()->json([
                'code' => 401,
                'message' => 'token không được gửi thông qua header'
            ], 401);
        } elseif ( empty($checkTokenIsValid)) {
            return response()->json([
                'code' => 401,
                'message' => 'token không hợp lệ'
            ], 401);
        } else {
            $products = Product::all();
            return response()->json([
                'code' => 200,
                'data' => $products
            ], 200);
        }
    }
}
