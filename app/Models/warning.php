<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warning extends Model
{
    use HasFactory;
    protected $fillable = ['title','description'];

    public function executions(){
        return $this->hasMany(execution::class);
    }
}
