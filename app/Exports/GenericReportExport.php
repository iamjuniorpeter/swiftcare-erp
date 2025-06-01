<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GenericReportExport implements FromView
{
    protected $records;
    protected $reportType;

    public function __construct($records, $reportType)
    {
        $this->records = $records;
        $this->reportType = $reportType;
    }

    public function view(): View
    {
        return view('reports.exports.' . $this->reportType, [
            'records' => $this->records
        ]);
    }
}
