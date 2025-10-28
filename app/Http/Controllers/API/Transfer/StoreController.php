<?php

namespace App\Http\Controllers\API\Transfer;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Transfer\StoreRequest;
use App\Http\Resources\API\Transfer\StoreResource;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request) {
        $data = $request->validated();
        $amount_from = DB::table('balances')->where('user_id', $data['user_id'])->value('amount');
        DB::transaction(function() use ($data, $amount_from) {
            $amount_to = DB::table('balances')->where('user_id', $data['to_user_id'])->value('amount');
            if (isset($amount_to)) {
                $amount_to = $amount_to - $data['amount'];
            }

            if ($amount_to > 0) {
                Transaction::create([
                    'user_id' => $data['user_id'],
                    'amount' => $data['amount'],
                    'comment' => $data['comment'],
                    'status' => 'transfer_in',
                ]);
                Transaction::create([
                    'user_id' => $data['to_user_id'],
                    'amount' => $data['amount'],
                    'comment' => $data['comment'],
                    'status' => 'transfer_out',
                ]);

                if (isset($amount_from)) {
                    $data['amount'] = $data['amount'] + $amount_from;
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
                DB::table('balances')
                    ->updateOrInsert(
                        [
                            'user_id' => $data['to_user_id']
                        ],
                        [
                            'amount' => $amount_to
                        ]
                );
            }
        });

        $update_balance = DB::table('balances')->where('user_id', $data['user_id'])->value('amount');

        if ($update_balance !== $amount_from) {
            $transaction = [
                'user_id' => (integer) $data['user_id'],
                'to_user_id' => (integer) $data['to_user_id'],
                'amount' => (integer) $data['amount'],
                'comment' => $data['comment'],
            ];

            return new StoreResource($transaction);
        } else {
            return response()->json([
                'message' => 'Недостаточно средств',
            ], 409);
        }
    }
}
