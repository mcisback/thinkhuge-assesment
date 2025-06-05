<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role']; 
    protected $hidden = ['password', 'remember_token'];

    public function movements() {
        return $this->hasMany(App\Models\Movement::class);
    }
}
