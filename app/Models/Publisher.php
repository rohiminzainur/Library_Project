<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use HasFactory;

    // use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone_number', 'address'
    ];

    protected $hidden = [

    ];

    public function books()
    {
        return $this->hasMany('App\Models\Book', 'publisher_id');
    }
}