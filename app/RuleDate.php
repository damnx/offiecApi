<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RuleDate extends Model
{
    protected $table = 'rule_date';
    protected $fillable = ['name','date','description'];
    public function user() {
        return $this->belongsToMany('App\User', 'rule_date_users', 'users_id', 'rule_date_id');
      }
}
