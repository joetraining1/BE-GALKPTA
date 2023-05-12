<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $fillable = ['report_id','nominal'];

    public function reports(){
        return $this->belongsTo(Report::class);
    }
}
