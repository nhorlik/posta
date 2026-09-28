<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['county_id', 'name', 'zip_code', 'population'];

    public function county()
    {
        return $this->belongsTo(County::class);
    }
}