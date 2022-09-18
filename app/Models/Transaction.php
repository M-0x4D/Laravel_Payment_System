<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model 
{

    protected $table = 'transactions';
    public $timestamps = true;
    protected $fillable = array('sender_account_number', 'receiver_account_number', 'amount', 'currency_id', 'service');

    public function client()
    {
        return $this->belongsTo('App\models\Client');
    }

    public function currency()
    {
        return $this->belongsTo('App\models\Currency');
    }

}