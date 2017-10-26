<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyGroup extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'company_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id','group_id'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
    public function carriers()
    {
        return $this->belongsToMany('App\Carrier');
    }
    public function role_permission()
    {
        return $this->hasMany('App\RolePermission', 'id_company_group');
    }
}
