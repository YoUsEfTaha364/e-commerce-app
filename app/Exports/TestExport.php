<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TestExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function collection()
    {
        return Product::select(
            'id',
            'name',
            'price',
            'quantity',
            'status',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Price',
            'Quantity',
            'Status',
            'Created At',
        ];
    }
}
