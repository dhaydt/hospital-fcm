<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'pasien_id', 'keluhan', 'datang', 'kembali'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'pasien_id');
    }
}
