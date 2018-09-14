<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tasks';

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'creator_id', 'user_id', 'name', 'link', 'status', 'time_comitted', 'time_start', 'time_end', 'finish', 'false', 'description',
    ];

    public function users()
    {
        return $this->hasMany('App\User', 'user_id', 'id');
    }

    public function createTask($request)
    {
        try {
            $task = Task::create($request);
            if (!$task) {
                return null;
            }
            return $task;
        } catch (\Exception $e) {
            return null;
        }
    }
}
