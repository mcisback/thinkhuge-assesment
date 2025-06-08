<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role']; 
    protected $hidden = ['password', 'remember_token'];

    public function movements() {
        return $this->hasMany(\App\Database\Models\Movement::class);
    }

    public function balance() {
        return $this->movements->reduce(function ($carry, $mov) {
            $sign = 1;

            if($mov->type === 'expense') {
                $sign = -1;
            }

            return $carry + $mov->amount * $sign;
        }, 0);
    }

    public static function clients() {
        return self::where('role', 'client')->get();
    }
}
