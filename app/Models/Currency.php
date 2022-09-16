<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies';
    public $timestamps = true;
    protected $fillable = array('name');



    public function transactions()
    {
        return $this->hasMany('App\models\Transaction');
    }
}

