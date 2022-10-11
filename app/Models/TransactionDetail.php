<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use HasFactory;

    // use SoftDeletes;

    protected $fillable = [
        'transaction_id', 'book_id', 'qty'
    ];

    protected $hidden = [

    ];

    public function transaction() {
        return $this->hasOne('App\Models\Transaction', 'transaction_id');
    }
}