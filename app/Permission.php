<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['permission'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function role_permission()
    {
        return $this->hasMany('App\RolePermission', 'id_permission');
    }
}
