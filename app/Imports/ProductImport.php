<?php

namespace App\Imports;

use App\Models\Mrp\MrpProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            MrpProduct::create(
                [
                    'product_code' => $row[0] ?? "-", 
                    'part_name' => $row[1] ?? "-",
                    'product_name' => $row[2] ?? "-",
                    'dim_long' => $row[3] ?? "-",
                    'dim_width' => $row[4] ?? "-",
                    'dim_height' => $row[5] ?? "-",
                    'dim_weight' => $row[6] ?? "-",
                    'part_number' => $row[11] ?? "-",
                    'unit_id' => $row[9] ?? "-",
                    'customer_id' => $row[10] ?? "-",

                ]
            );
        }
    }
}
