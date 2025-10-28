<?php

namespace App\Http\Controllers\API\Withdraw;

use App\Models\Transaction;
use App\Models\HistoryTransfer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Withdraw\StoreRequest;
use App\Http\Resources\API\Withdraw\StoreResource;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        DB::transaction(function() use ($data) {
            $amount = DB::table('balances')->where('user_id', $data['user_id'])->value('amount');
            if (isset($amount)) {
                $amount = $amount - $data['amount'];
            }

            if ($amount > 0) {
                Transaction::create([
                    'user_id' => $data['user_id'],
                    'amount' => $data['amount'],
                    'comment' => $data['comment'],
                    'status' => 'withdraw',
                ]);
                DB::table('balances')
                    ->updateOrInsert(
                        [
                            'user_id' => $data['user_id']
                        ],
                        [
                            'amount' => $amount
                        ]
                );
            }
        });

        $transaction = DB::table('transactions')
            ->where([
                ['user_id', '=', $data['user_id']],
                ['amount', '=', $data['amount']],
                ['comment', $data['comment']],
                ['status', 'withdraw'],
            ])
            ->first();

        if (isset($transaction)) {

            return new StoreResource($transaction);
        } else {

            return response()->json([
                'message' => 'Недостаточно средств',
            ], 409);
        }
    }
}
