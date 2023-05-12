<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;
    protected $fillable = ['initiator_id','todo_id', 'duration'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function todos(){
        return $this->belongsTo(Todo::class);
    }

    public function rosters(){
        return $this->hasMany(Roster::class);
    
    }
}
