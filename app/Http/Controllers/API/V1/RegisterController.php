<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Position;
use App\Services\ImageServiceInterface;

class RegisterController extends Controller
{
    public function __construct(
        private TokenController       $tokenController,
        private ImageServiceInterface $imageService
    )
    {
    }

    public function register(RegisterRequest $request)
    {
        $params = $request->validated();

        $url = $this->imageService->crop($params['photo']);
        $params['photo'] = $url;

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
