<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role_name'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function users()
    {
        return $this->hasMany('App\User', 'role_id');
    }

    public function role_permission()
    {
        return $this->hasMany('App\RolePermission', 'id_role');
    }
}
