<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKomputer extends Model
{
    use HasFactory;

    protected $table = 'list_komputer';

    protected $fillable = [
        'warnet_id',
        'nama_komputer',
        'processor',
        'ram',
        'gpu',
    ];

    public function warnet()
    {
        return $this->belongsTo(Warnet::class);
    }
}
