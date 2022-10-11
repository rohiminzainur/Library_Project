<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;

    // use SoftDeletes;

    protected $fillable = [
        'name', 'gender', 'phone_number', 'address', 'email'
    ];

    protected $hidden = [

    ];

    public function transaction() {
        return $this->belongsTo('App\Models\Transaction', 'member_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'member_id');
    }
}