<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
    
class Device extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devices';
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
        return $this->hasMany('App\Ticket', 'id_device');
    }
    public function items()
    {
        return $this->hasMany('App\Checklist', 'device_id');
    }
    public function services()
    {
        return $this->hasMany('App\Service', 'device_id');
    }
}
