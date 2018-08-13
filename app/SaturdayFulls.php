<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaturdayFulls extends Model
{
    protected $table = 'saturday_fulls';

    protected $fillable = [
        'id_group_users', 'date_saturday_fulls',
    ];

    public function groupUser()
    {
        return $this->belongsTo('App\GroupUser', 'id_group_users', 'id');
    }
}