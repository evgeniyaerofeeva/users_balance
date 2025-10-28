<?php

namespace App\Http\Controllers\API\Deposit;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Deposit\StoreRequest;
use App\Http\Resources\API\Deposit\StoreResource;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        DB::transaction(function() use ($data) {
            Transaction::create([
                'user_id' => $data['user_id'],
                'amount' => $data['amount'],
                'comment' => $data['comment'],
                'status' => 'deposit',
            ]);
            $amount = DB::table('balances')->where('user_id', $data['user_id'])->value('amount');
            if (isset($amount)) {
                $data['amount'] = $data['amount'] + $amount;
            }
            DB::table('balances')
                ->updateOrInsert(
                    [
                        'user_id' => $data['user_id']
                    ],
                    [
                        'amount' => $data['amount']
                    ]
            );
        });

        $transaction = DB::table('transactions')
            ->where([
                ['user_id', '=', $data['user_id']],
                ['amount', '=', $data['amount']],
                ['comment', $data['comment']],
                ['status', 'deposit'],
            ])
            ->first();

        return new StoreResource($transaction);
    }
}
