<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use App\Models\User;

class CreateController extends Controller
{
    public function __invoke() {
        $users = User::all();

        if (empty($users->first()) || $users->count() == 1) {
            return response()->json([
                'message' => '404 — пользователь не найден',
            ], 404);
        }

        return view('transfer.create',
            compact('users')
        );
    }
}
