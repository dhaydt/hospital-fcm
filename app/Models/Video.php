<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'cat_id', 'url'];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(category::class, 'cat_id');
    }
}
