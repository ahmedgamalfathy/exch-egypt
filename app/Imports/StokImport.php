<?php

namespace App\Imports;

use App\Models\Stok;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (empty($row['code'])) {
            return null; // تجاوز الصفوف التي تحتوي على 'code' فارغ
        }

        return new Stok([
            'code' => $row['code'],
            'stock_name' => $row['stock_name'],
            'closing_price_year' => $row['closing_price_year'],
            'closing_price_today' => $row['closing_price_today'],
            'annual_growth_rate' => is_numeric($row['annual_growth_rate']) ? $row['annual_growth_rate'] : (float) str_replace('-', '', $row['annual_growth_rate']) * -1,
            'internal_liquidity_volume' => $row['internal_liquidity_volume'],
            'internal_liquidity_value' => $row['internal_liquidity_value'],
            'external_liquidity_volume' => $row['external_liquidity_volume'] ?? null,
            'external_liquidity_value' => $row['external_liquidity_value'] ?? null,
            'net_liquidity' => is_numeric($row['net_liquidity']) ? $row['net_liquidity'] : (float) str_replace('-', '', $row['net_liquidity']) * -1,
            'liquidity_ratio' => $row['liquidity_ratio'],
            'trading_volume' => $row['trading_volume'],
        ]);
    }
}
