<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class accounts extends Model
{
    protected $guarded = [];

    public function scopeConsignee($query)
    {
        return $query->where('type', 'Consignee');
    }
}
