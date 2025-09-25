<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
