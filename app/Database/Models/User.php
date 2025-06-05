<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';        // Optional if class name matches
    protected $fillable = ['name', 'email', 'password', 'role']; // Mass-assignable fields
    protected $hidden = ['password', 'remember_token'];
}
