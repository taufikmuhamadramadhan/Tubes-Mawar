<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
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
}
