<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class region extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    public function areas(){
        return $this->hasMany(area::class);
    }
}
