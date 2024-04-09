<?php

namespace app\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserRequest $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('count', 5);

        $users = User::select('users.*', 'positions.position as position', 'positions.id as position_id')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->orderBy('users.id', 'asc')
            ->paginate($perPage, ['*'], 'page', $page)
            ->appends(['count' => $perPage]);

        if ($users->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        $users = UserResource::collection($users);

        $response = [
            'success' => true,
            'page' => $users->currentPage(),
            'total_pages' => $users->lastPage(),
            'total_users' => $users->total(),
            'count' => $users->count(),
            'links' => [
                'next_url' => $users->nextPageUrl(),
                'prev_url' => $users->previousPageUrl()
            ],
            'users' => $users->items()
        ];

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
