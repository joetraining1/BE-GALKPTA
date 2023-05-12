<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deployment extends Model
{
    use HasFactory;
    protected $fillable = ['area_id', 'office'];

    public function areas(){
        return $this->belongsTo(area::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
