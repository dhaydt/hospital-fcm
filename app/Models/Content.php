<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'cat_id', 'image', 'description', 'kembali'];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(category::class, 'cat_id');
    }
}
