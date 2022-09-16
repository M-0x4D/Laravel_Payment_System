<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->hasMany('App\models\Client');
    }

    public function country()
    {
        return $this->belongsTo('App\models\Country');
    }

}