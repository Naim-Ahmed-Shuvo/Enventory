<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'id' => $row[0],
            'cat_id' => $row[1],
            'p_name' => $row[2],
            'sup_id' => $row[3],
            'p_code' => $row[4],
            'p_garage' => $row[5],
            'p_route' => $row[6],
            'p_image' => $row[7],
            'buy_date' => $row[8],
            'expire_date' => $row[9],
            'selling_price' => $row[10],
            'buying_price' => $row[11],
        ]);
    }
}
