<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','device_id','type'];

    /**
     * [users description].
     *
     * @return [type] [description]
     */
    public function device()
    {
        return $this->belongsTo('App\Device', 'device_id');
    }
    
    public function tickets()
    {
        return $this->belongsToMany('App\Ticket');
    }
}
