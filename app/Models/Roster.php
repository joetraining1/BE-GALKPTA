<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','ovt_id'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function overtimes(){
        return $this->belongsTo(Overtime::class);
    }
}
