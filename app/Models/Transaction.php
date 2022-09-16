<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model 
{

    protected $table = 'transactions';
    public $timestamps = true;
    protected $fillable = array('sender_id', 'receiver_id', 'amount', 'currency', 'service');

    public function client()
    {
        return $this->belongsTo('App\models\Client');
    }

}