<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salary extends Model
{
    use HasFactory;
    protected $fillable = ['nominal'];

    public function ranks(){
        return $this->hasMany(Rank::class);
    }
}
