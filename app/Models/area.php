<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'region_id'];

    public function regions(){
        return $this->belongsTo(region::class);
    }

    public function deployments(){
        return $this->hasMany(deployment::class);
    }
}
