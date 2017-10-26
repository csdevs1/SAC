<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistTicket extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'checklist_ticket';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['checklist_id','ticket_id','observation'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function checklist()
    {
        return $this->belongsTo('App\Checklist', 'checklist_id');
    }
    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'ticket_id');
    }
}
