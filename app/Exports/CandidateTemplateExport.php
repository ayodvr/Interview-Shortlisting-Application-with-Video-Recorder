<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CandidateTemplateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return [];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'NAME',
            'EMAIL',
            'PHONE'
        ];
    }
}
