<?php

require_once __DIR__ . "/../../bootstrap/database.php";

use Illuminate\Database\Capsule\Manager as DB;

DB::schema()->dropIfExists('movements');

DB::schema()->create('movements', function ($table) {

       $table->increments('id');

       // deposit|expense|earning
       $table->string('type')->defaul('deposit');

       $table->unsignedInteger('amount');

       $table->unsignedInteger('user_id');
       $table->foreign('user_id')
         ->references('id')
         ->on('users')
         ->onDelete('CASCADE');

       $table->timestamps();
});
