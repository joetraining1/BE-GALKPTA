<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    public function todos(){
        return $this->hasMany(Todo::class);
    }

    public function ranks(){
        return $this->hasMany(Rank::class);
    }
}
