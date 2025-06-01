<?php

// app/Exports/InventoryReportExport.php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoryReportExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($start, $end)
    {
        $this->startDate = $start;
        $this->endDate = $end;
    }

    public function collection()
    {
        return Item::whereBetween('created_at', [$this->startDate, $this->endDate])->get([
            'item_code',
            'name',
            'cost_price',
            'selling_price',
            'reorder_level',
            'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'Item Code',
            'Name',
            'Cost Price',
            'Selling Price',
            'Reorder Level',
            'Created At'
        ];
    }
}
