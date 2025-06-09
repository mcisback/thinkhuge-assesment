<?php

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model {
    protected $table = 'movements';
    protected $fillable = ['type', 'amount', 'user_id'];

    protected static function booted() {
        static::addGlobalScope('ordered', function ($builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    public function user() {
        return $this->belongsTo(\App\Database\Models\User::class);
    }
}
