<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoleUsers extends Model
{
    //
    protected $table = 'roles';
    protected $fillable = [
        'user_id', 'role_id',
    ];
}
