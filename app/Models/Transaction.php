<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'date_start', 'date_end', 'status'
    ];

    protected $hidden = [

    ];

    public function members() {
        return $this->hasOne('App\Models\Member', 'id');
    }

    public function transactionDetail() {
        return $this->belongsTo('App\Models\TransactionDetail', 'transaction_id');
    }
}