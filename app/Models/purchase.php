<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transportor()
    {
        return $this->belongsTo(accounts::class);
    }

}
