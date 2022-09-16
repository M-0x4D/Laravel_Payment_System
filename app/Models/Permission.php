<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    public $timestamps = true;
    protected $fillable = array('name', 'guard_name');


    //! client ==> one relation 

    public function permission_client()
    {
        return $this->belongsToMany('App\models\Client' , 'model_has_permissions');
    }



    //! role ==> one relation 
    
    public function permission_role()
    {
        return $this->belongsToMany('App\models\Role' , 'role_has_permissions' );
    }
}
