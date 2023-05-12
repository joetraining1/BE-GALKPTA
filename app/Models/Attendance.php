<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'status_id'];

    public function users(){
        return $this->belongsTo(User::class);
    
    }
    public function statuses(){
        return $this->belongsTo(status::class);
    }
}
