<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = ['department_id', 'role_id', 'title', 'description'];

    public function departments(){
        return $this->belongsTo(department::class);
    }

    public function roles(){
        return $this->belongsTo(role::class);
    }

    public function overtimes(){
        return $this->hasMany(Overtime::class);    
    }
}
