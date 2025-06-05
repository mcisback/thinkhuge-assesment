<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role']; 
    protected $hidden = ['password', 'remember_token'];

    public function movements() {
        return $this->hasMany(App\Database\Models\Movement::class);
    }

    public static function clients() {
        return self::where('role', 'client')->get();
    }
}
