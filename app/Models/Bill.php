<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $guarded = [];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    function status() {
        return $this->state == 0 ? 'لم يتم التسليم' : 'تم التسليم';
    }
}