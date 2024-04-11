<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Position;
use App\Models\Token;

class RegisterController extends Controller
{
    public function __construct(
        private TokenController $tokenController
    )
    {
    }

    public function register(RegisterRequest $request)
    {
        $params = $request->validated();

        $position = Position::where('id', $params['position_id'])->first();
        $user = $position->users()->create($params);

        $this->tokenController->revokeToken($params['token']);

        $response = [
            'success' => true,
            'user_id' => $user->id,
            'message' => 'New user successfully registered'
        ];

        return response()->json($response, 201);
    }
}
