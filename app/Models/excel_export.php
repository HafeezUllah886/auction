<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class excel_export extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "excel_export";

    public function cars()
    {
        return $this->hasMany(excel_export_cars::class);
    }

    public function parts()
    {
        return $this->hasMany(excel_export_parts::class);
    }

}
