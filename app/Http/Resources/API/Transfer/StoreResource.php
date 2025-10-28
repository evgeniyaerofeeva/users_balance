<?php

namespace App\Http\Resources\API\Transfer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'from_user_id' => $request->user_id,
            'to_user_id' => $request->to_user_id,
            'amount' => $request->amount,
            'comment' => $request->comment,
        ];
    }
}
