<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','phone','email','position','enable','company_id'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function ticket()
    {
        return $this->hasMany('App\Ticket', 'reported_by');
    }
}
