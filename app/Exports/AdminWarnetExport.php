<?php

namespace App\Exports;

use App\Models\AdminWarnet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminWarnetExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return AdminWarnet::with('warnet')->get()->map(function ($adminWarnet, $index) {
            return [
                'No' => $index + 1,
                'Nama Warnet' => $adminWarnet->warnet->nama_warnet,
                'Nama' => $adminWarnet->name,
                'Email' => $adminWarnet->email,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Warnet',
            'Nama',
            'Email',
        ];
    }
}
