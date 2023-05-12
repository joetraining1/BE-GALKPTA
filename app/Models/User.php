<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'rank_id',
        'deployment_id',
        'bank_id',
        'type_id',
        'name',
        'phone',
        'gender',
        'email',
        'bank_account',
        'password',
        'alamat',
    ];

    public function ranks(){
        return $this->belongsTo(Rank::class);
    }

    public function departments(){
        return $this->belongsTo(department::class);
    }

    public function deployments(){
        return $this->belongsTo(deployment::class);
    }

    public function banks(){
        return $this->belongsTo(Bank::class);
    }

    public function types(){
        return $this->belongsTo(type::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function offdays(){
        return $this->hasMany(Offday::class);
    }

    public function executions(){
        return $this->hasMany(execution::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function overtimes(){
        return $this->hasMany(Overtime::class);
    }

    public function rosters(){
        return $this->hasMany(Roster::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
