<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class excel_export_parts extends Model
{
    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsTo(purchase::class);
    }
}
