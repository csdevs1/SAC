<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceTicket extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_ticket';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['service_id','ticket_id','cant'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }
    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'ticket_id');
    }
}
