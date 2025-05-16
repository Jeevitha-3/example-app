<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique;
            $table->string('phonenumber', 10);
            $table->text('address');
            $table->string('city');
            $table->string('state');    
            $table->string('country');
            $table->string('zipcode', 6);
            $table->integer('role');
            $table->enum('gender',['male','female']);
            $table->date('dob');
            $table->timestamps();
        });
    }

    /**
     *
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registers');
    }
}
