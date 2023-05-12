<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class annual extends Model
{
    use HasFactory;
    protected $fillable = ['title','description'];
    
    public function offdays(){
        return $this->hasMany(Offday::class);
    }
}
