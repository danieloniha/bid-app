<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $guarded = [];

    // public function tender()
    // {
    //     return $this->belongsTo(Tender::class);
    // }

    protected $casts = [
        'document' => 'array',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
