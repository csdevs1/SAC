<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','phone'];

    public function employees()
    {
        return $this->hasMany('App\Employee', 'company_id');
    }
    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }
}
