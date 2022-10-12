<?php

namespace App\Imports;

use App\Models\Dollars;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use Hash;


class DollarrateImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dollars([
            'dollarrate_rate'          => $row['dollarrate_rate'],
            'dollarrate_date'   => $row['dollarrate_date'],
          
            
        ]);
    }
}
