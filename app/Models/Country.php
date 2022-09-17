<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model 
{

    protected $table = 'countries';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->hasMany('App\models\Client');
    }

    public function cities()
    {
        return $this->hasMany('App\models\City');
    }



    public function governrates()
    {
        return $this->hasMany('App\models\Governrate');
    }

}