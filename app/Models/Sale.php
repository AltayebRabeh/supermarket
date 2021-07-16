<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    public function bill()
    {
        return $this->belongsTo(bill::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}