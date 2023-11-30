<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class CustomerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithStyles
{
    public function collection()
    {
        return Customer::get()->map(function ($customer, $index) {
            return [
                'No' => $index + 1,
                'Nama' => $customer->nama_customer,
                'Username' => $customer->username,
                'Billing' => $customer->billing,
                'No Telp' => $customer->no_telp,
                'Create Date' => $customer->create_date,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Username',
            'Billing',
            'No Telp',
            'Create Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menambahkan border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow())->applyFromArray($styleArray);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Implementasi kustom setelah lembar telah dibuat
            },
        ];
    }
}
