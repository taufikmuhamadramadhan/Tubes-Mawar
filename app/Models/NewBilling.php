<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewBilling extends Model
{
    use HasFactory;

    protected $table = 'new_billing';

    protected $fillable = [
        'id_warnet',
        'id_komputer',
        'id_customer',
        'billing',
        'exp_date',
        'harga',
    ];

    // Define relationships
    public function warnet()
    {
        return $this->belongsTo(Warnet::class, 'id_warnet');
    }

    public function komputer()
    {
        return $this->belongsTo(ListKomputer::class, 'id_komputer');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    // Metode setter untuk billing
    public function setBillingAttribute($value)
    {
        $this->attributes['billing'] = $value;

        // Set exp_date berdasarkan nilai billing
        $this->setExpDate();

        // Set harga berdasarkan nilai billing
        $this->setHarga();
    }

    // Metode setter untuk exp_date
    protected function setExpDate()
    {
        $expDate = $this->attributes['billing'] <= 4 ? now()->addDays(2) : now()->addDays(3);
        $this->attributes['exp_date'] = $expDate;
    }

    // Metode setter untuk harga
    protected function setHarga()
    {
        $hargaKomputer = $this->list_komputer->harga; // Sesuaikan dengan nama kolom yang benar
        $this->attributes['harga'] = $this->attributes['billing'] * $hargaKomputer;
    }
}
