<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Scopes\ActiveDataScope;
use App\Trait\FunctionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, FunctionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
        'password' => 'hashed',
    ];

    public function last_login(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LastLogin::class);
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }


    public function state(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function Fun($data)
    {
        return self::FormatDate($data);
    }

    public function Status($status)
    {
        return self::ChangeStatus($status);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function working_status($work_status)
    {
        return self::CheckWorkingStatus($work_status);
    }
    // protected static function booted() {
    //     static::addGlobalScope(new ActiveDataScope);
    // }
}
