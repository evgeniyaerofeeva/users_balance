<?php

namespace App\Http\Controllers\Withdraw;

use App\Models\User;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke() {
        $users = User::all();

        if (empty($users->first())) {
            return response()->json([
                'message' => '404 — пользователь не найден',
            ], 404);
        }

        return view('withdraw.create',
            compact('users')
        );
    }
}
