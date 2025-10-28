<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BalanceRequest;
use App\Http\Resources\API\BalanceResource;
use App\Models\Balance;

class BalanceController extends Controller
{
    public function __invoke(BalanceRequest $request, $id)
    {
        $balance = Balance::where('user_id', $id)->first();

        if (empty($balance)) {
            return response()->json([
                'message' => 'У пользователя нет средств',
            ], 409);
        }

        return new BalanceResource($balance);
    }
}
