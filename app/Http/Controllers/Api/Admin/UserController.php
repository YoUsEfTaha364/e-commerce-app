<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\api_response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select(
                'id',
                'firstname',
                'lastname',
                'email',
                'is_admin',
                'created_at'
            )
            ->latest()
            ->paginate(15);

        return api_response::Response(
            200,
            'Users fetched successfully',
            $users
        );
    }


    public function show($id)
{
    $user = User::with([
            'orders' => function ($q) {
                $q->latest();
            }
        ])
        ->select(
            'id',
            'firstname',
            'lastname',
            'email',
            'is_admin',
            'created_at'
        )
        ->find($id);

    if (! $user) {
        return api_response::Response(
            404,
            'User not found',
            null
        );
    }

    return api_response::Response(
        200,
        'User details fetched successfully',
        $user
    );
}

}
