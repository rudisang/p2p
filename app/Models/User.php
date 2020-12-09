<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'gender',
        'omang',
        'isAdmin',
        'isUser',
        'occupation',
        'salary',
        'employer',
        'employer_email',
        'phone',
        'address',
        'residence',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function lenders(){
        return $this->hasOne('App\Models\Lender');
    }

    public function applications(){
        return $this->hasMany('App\Models\Application');
    }
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
