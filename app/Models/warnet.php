<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warnet extends Model
{
    protected $primaryKey = 'id_warnet';
    protected $table = 'warnet';
    protected $fillable = [
        'nama_warnet',
        'alamat',
    ];
    public $timestamps = true;

    public function AdminWarnet()
    {
        return $this->hasOne(AdminWarnet::class, 'id_warnet', 'id');
    }
}
