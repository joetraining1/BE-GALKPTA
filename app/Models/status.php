<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;
    protected $fillable = ['title','description'];

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function offdays(){
        return $this->hasMany(Offday::class);
    }
}
