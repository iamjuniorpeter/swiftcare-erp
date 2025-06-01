<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;


class ItemBulkTemplateExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return collect([
            [
                'Sample Item',
                'Sample description of item',
                1,
                1,
                100.00,
                150.00,
                10,
                'active'
            ]
        ]);
    }

    public function headings(): array
    {
        return [
            'name',
            'description',
            'category id',
            'unit id',
            'cost price',
            'selling price',
            'reorder level',
            'status'
        ];
    }
}
