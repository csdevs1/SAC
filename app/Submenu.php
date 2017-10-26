<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','url','menu_id','icon'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu_id');
    }
    
    public function role_permission()
    {
        return $this->hasMany('App\RolePermission', 'id_submenu');
    }
}
