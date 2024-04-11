<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Token;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function getToken()
    {
        $expired_at = now()->addMinutes(120);

        $payload = [
            'exp' => $expired_at
        ];

        $key = env('JWT_SECRET');

        $jwt = JWT::encode($payload, $key, 'HS256');

        $token = Token::create([
            'token' => $jwt,
            'expired_at' => $expired_at,
        ]);

        $response = [
            'success' => true,
            'token' => $token->token
        ];

        return response()->json($response);
    }

    public function revokeToken($token)
    {
        $token = Token::where('token', $token)->first();
        $token->update([
            'revoke' => true
        ]);
    }
}
