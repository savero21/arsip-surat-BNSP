<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Letter extends Model
{
    protected $fillable = ['number','category_id','title','archived_at','file_path'];

    protected $casts = [
        'archived_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // scope pencarian judul/nomor
    public function scopeSearch(Builder $q, $term)
    {
        $term = trim($term);
        if ($term === '') return $q;

        return $q->where(function ($qq) use ($term) {
            $qq->where('title', 'like', "%$term%")
               ->orWhere('number', 'like', "%$term%");
        });
    }
}
