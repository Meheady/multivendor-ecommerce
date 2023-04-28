<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
{
    use HasFactory;
    protected  $guarded = [];

    public function division()
    {
        return $this->hasOne(ShipDivision::class,'id','division_id');
    }
    public function district()
    {
        return $this->hasOne(ShipDistrict::class,'id','district_id');
    }
}
