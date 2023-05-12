<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    public function ranks(){
        return $this->hasMany(Rank::class);
    }
}
