<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['kode_kategori','name', 'description'];

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }
}