<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class execution extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','executioner_id', 'warning_id', 'notes'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function warnings(){
        return $this->belongsTo(warning::class);
    
    }
}
