<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offday extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','permitter_id', 'absence_id', 'annual_id', 'status_id', 'start_date' , 'comeback', 'reason'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function absences(){
        return $this->belongsTo(absence::class);
    }

    public function annuals(){
        return $this->belongsTo(annual::class);
    }

    public function statuses(){
        return $this->belongsTo(status::class);
    }
}
