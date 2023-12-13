<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewBilling extends Model
{
    use HasFactory;

    protected $table = 'billing';

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
        return $this->belongsTo(User::class, 'id');
    }
}