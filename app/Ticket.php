<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','priority','status','report','solution','reported_by','id_user','id_sac','id_installer','id_device','id_tck_type','id_vehicle','id_company_group','id_carrier_group'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'reported_by');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    public function sac()
    {
        return $this->belongsTo('App\Sac', 'id_sac');
    }
    public function device()
    {
        return $this->belongsTo('App\Device', 'id_device');
    }
    public function ticket_type()
    {
        return $this->belongsTo('App\TicketType', 'id_tck_type');
    }
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle', 'id_vehicle');
    }
    public function companyGroup()
    {
        return $this->belongsTo('App\CompanyGroup', 'id_company_group');
    }
    public function carrierGroup()
    {
        return $this->belongsTo('App\CarrierGroup', 'id_carrier_group');
    }
    
    public function checklists()
    {
        return $this->belongsToMany('App\Checklist');
    }
}
