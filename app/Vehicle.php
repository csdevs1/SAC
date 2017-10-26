<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['plate','company_id'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function comapany()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
    
    public function ticket()
    {
       // return $this->hasMany('App\Ticket', 'id_vehicle');
    }
}
