<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StokResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //code, stock_name, closing_price_year, closing_price_today,annual_growth_rate,internal_liquidity_volume
//internal_liquidity_value ,external_liquidity_volume ,external_liquidity_value, net_liquidity
//liquidity_ratio, trading_volume
        return [
            "code"=>$this->code,
            "stock_name"=>$this->stock_name,
            "closing_price_year"=>$this->closing_price_year,
            "closing_price_today"=>$this->closing_price_today,
            "annual_growth_rate"=>$this->annual_growth_rate,
            "internal_liquidity_volume"=>$this->internal_liquidity_volume,
            "internal_liquidity_value"=>$this->internal_liquidity_value,
            "external_liquidity_volume"=>$this->external_liquidity_volume,
            "external_liquidity_value"=>$this->external_liquidity_value,
            "net_liquidity"=>$this->net_liquidity,
            "liquidity_ratio"=>$this->liquidity_ratio,
            "trading_volume"=>$this->trading_volume,
            "news"=> NewResource::collection($this->news)
        ];
    }
}
