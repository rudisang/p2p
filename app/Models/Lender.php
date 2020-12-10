<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function applications(){
        return $this->hasMany('App\Models\Application');
    }

    protected $fillable = [
        'interest','company_name', 'category', 'description', 'phone', 'verified'
    ];
}
