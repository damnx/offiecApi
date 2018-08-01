<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RuleDateUsers extends Model
{
    protected $table = 'rule_date_users';
    protected $fillable = ['users_id', 'rule_date_id'];
}
