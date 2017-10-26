<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_permission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_role','id_permission','id_menu','id_submenu','id_company_group'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function role()
    {
        return $this->belongsTo('App\Role', 'id_role');
    }
    public function permission()
    {
        return $this->belongsTo('App\Permission', 'id_permission');
    }
    public function menu()
    {
        return $this->belongsTo('App\Menu', 'id_menu');
    }
    public function submenu()
    {
        return $this->belongsTo('App\Submenu', 'id_submenu');
    }
    public function company_group()
    {
        return $this->belongsTo('App\CompanyGroup', 'id_company_group');
    }
}
