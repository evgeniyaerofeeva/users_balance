<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Balance;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index() {
        $users = User::all();

        return view('balance.users',
            compact('users')
        );
    }

    public function show(Request $request, $id) {
        $user = User::where('id', $id)->first();
        $user_balance = Balance::where('user_id', $id)->first();

        if (empty($user_balance->amount)) {
            return response()->json([
                'message' => 'У пользователя нет средств',
            ], 409);
        }

        $balance = [
            'name' => $user->name,
            'email' => $user->email,
            'amount' => $user_balance->amount,
        ];

        return view('balance.show',
            compact('balance')
        );
    }
}
