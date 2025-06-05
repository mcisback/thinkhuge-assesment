<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model {
    protected $table = 'movements';
    protected $fillable = ['type', 'amount'];
}
