<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [

    ];

    public function books()
    {
        return $this->hasMany('App\Models\Book', 'catalog_id');
    }
}