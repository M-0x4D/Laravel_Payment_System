<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $table = 'role_has_permissions';
    public $timestamps = true;
    protected $fillable = array('role_id' , 'permission_id');
}
