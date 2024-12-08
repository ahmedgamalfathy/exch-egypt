<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'index'=>$this->index,
            'closing'=>$this->closing,
            'change'=>$this->change,
            'change_percentage'=>$this->change_percentage,
            'high'=>$this->high,
            'low'=>$this->low,
            'volume'=>$this->volume,
            'value'=>$this->value,
            'transactions'=>$this->transactions,
            'net_liquidity'=>$this->net_liquidity,
            'created_at'=> \Carbon\Carbon::parse($this->updated_at)->diffForHumans()
        ];
    }
}
