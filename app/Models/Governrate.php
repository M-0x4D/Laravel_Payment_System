<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governrate extends Model
{
    use HasFactory;

    protected $table = 'governrates';
    public $timestamps = true;
    protected $fillable = array('name' , 'country_id');



    public function cities()
    {
        return $this->hasMany('App\models\City');
    }



    public function country()
    {
        return $this->belongsTo('App\models\Country');
    }
}
