<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
    
class TicketType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ticket_type';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function ticket()
    {
        return $this->hasMany('App\Ticket', 'id_tck_type');
    }
}
