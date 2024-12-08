<?php

namespace App\Imports;

use App\Models\Sector;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class SectorImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sector([
            'index'=>$row['index'],
            'closing'=>$row['closing'],
            'change'=>is_numeric($row['change']) ? $row['change'] : (float) str_replace('-', '', $row['change']) * -1,
            'change_percentage'=>is_numeric($row['change_percentage']) ? $row['change_percentage'] : (float) str_replace('-', '', $row['change_percentage']) * -1,
            'high'=>$row['high'],
            'low'=>$row['low'],
            'volume'=>$row['volume'],
            'value'=>$row['value'],
            'transactions'=>$row['transactions'],
            'net_liquidity'=>is_numeric($row['net_liquidity']) ? $row['net_liquidity'] : (float) str_replace('-', '', $row['net_liquidity']) * -1,
        ]);
    }
}
