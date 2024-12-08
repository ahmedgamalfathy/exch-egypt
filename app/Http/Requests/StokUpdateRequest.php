<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StokUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "code"=>"required|string",
            "stock_name"=>"required|string",
            "closing_price_year"=>"required|numeric",
            "closing_price_today"=>"required|numeric",
            "annual_growth_rate"=>"required|numeric",
            "internal_liquidity_volume"=>"nullable|integer",
            "internal_liquidity_value"=>"nullable|integer",
            "external_liquidity_volume"=>"nullable|integer",
            "external_liquidity_value"=>"nullable|integer",
            "net_liquidity"=>"required|integer",
            "liquidity_ratio"=>"required|numeric",
            "trading_volume"=>"required|integer",
        ];
    }
}
