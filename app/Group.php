<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    
    public function companies()
    {
        return $this->belongsToMany('App\Company');
    }
    public function ticket()
    {
        return $this->hasMany('App\Ticket', 'id_company_group');
    }
}
