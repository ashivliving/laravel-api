<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userpro extends Model
{
     protected $fillable = [
        'id','name', 'email', 'age', 'profileImage',
    ];

}
