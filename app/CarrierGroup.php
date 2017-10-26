<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarrierGroup extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carrier_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['carrier_id','company_group_id'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function company_group()
    {
        return $this->belongsTo('App\CompanyGroup', 'company_group_id');
    }
    public function carrier()
    {
        return $this->belongsTo('App\Carrier', 'carrier_id');
    }
    public function ticket()
    {
        return $this->hasMany('App\Ticket', 'id_carrier_group');
    }
}
