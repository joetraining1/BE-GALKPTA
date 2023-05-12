<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_id',
        'salary_id',
        'education_id',
        'role_id',
        'position_id',
        'level',
        'paid_leave',
        'vacation'
    ];

    public function contracts(){
        return $this->belongsTo(contract::class);
    }

    public function salaries(){
        return $this->belongsTo(salary::class);
    }

    public function educations(){
        return $this->belongsTo(education::class);
    }

    public function roles(){
        return $this->belongsTo(role::class);
    }

    public function positions(){
        return $this->belongsTo(position::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
