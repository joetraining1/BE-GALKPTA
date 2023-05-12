<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','reviewer_id', 'class_id', 'ondays', 'offdays', 'overtimes', 'summary', 'review'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function classifications(){
        return $this->belongsTo(classification::class);
    }
}
