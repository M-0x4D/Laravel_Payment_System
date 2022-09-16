<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleClient extends Model
{
    use HasFactory;

    protected $table = 'model_has_roles';
    public $timestamps = true;
    protected $fillable = array('model_id', 'role_id' , 'model_type');
}
