<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'main_menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','url','icon'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function submenu()
    {
        return $this->hasMany('App\Submenu', 'menu_id');
    }
    
    public function role_permission()
    {
        return $this->hasMany('App\RolePermission', 'id_menu');
    }
}
