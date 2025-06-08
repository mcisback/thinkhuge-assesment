<?php

require_once __DIR__ . "/../../bootstrap/database.php";

use Illuminate\Database\Capsule\Manager as DB;

DB::schema()->dropIfExists('users');

DB::schema()->create('users', function ($table) {

       $table->increments('id');

       $table->string('name');

       // client|admin
       $table->string('role')->default('client');

       $table->string('email')->unique();

       $table->string('password');

       $table->boolean('allow_login')->default(false);

    //    $table->string('userimage')->nullable();

       $table->string('api_key')->nullable()->unique();

       $table->rememberToken();

       $table->timestamps();

});
