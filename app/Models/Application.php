<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function lender(){
        return $this->belongsTo('App\Models\Lender');
    }

    protected $fillable = [
        'amount', 'plan', 'user_id', 'lender_id', 'isApproved', 'isPending', 'message'
    ];

}
