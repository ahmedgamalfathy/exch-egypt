<?php

namespace App\Imports;

use App\Models\Agenda;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class AgendasImoprt implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Agenda([
            'company_name' => $row['company_name'],
            'currency' => $row['currency'],
            'payer' => $row['payer'],
            'coupon_number' => $row['coupon_number'],
            'coupon_value' => $row['coupon_value'],
            'maturity_date' =>date('Y-m-d', strtotime($row['maturity_date'])),
            'transaction_date' => date('Y-m-d', strtotime($row['maturity_date'])),
        ]);
    }
}
