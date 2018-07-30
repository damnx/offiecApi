<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = [
<<<<<<< HEAD
        'name', 'permissions', 'description',
    ];

    
=======
        'name', 'permission', 'description'
    ];
>>>>>>> c8bdd501c26abd2b18090ad57522caf755475729
}
