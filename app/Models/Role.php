<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    public $timestamps = true;
    protected $fillable = array('name', 'guard_name');

    //! client ==> one relation 
    
    public function role_client()
{
    return $this->belongsToMany('App\models\Client' , 'model_has_roles' , 'id');
}


//! permission ==> one relation 
    
public function role_permission()
{
    return $this->belongsToMany('App\models\Permission' , 'role_has_permissions' , 'id');
}

}
