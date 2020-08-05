<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("video")->nullable();
            $table->string("curriculum")->nullable();
            $table->string("rut")->nullable();
            $table->date("birth_date")->nullable();
            $table->string("gender")->nullable();
            $table->string("civil_state")->nullable();
            $table->text("address")->nullable();
            $table->string("city")->nullable();
            $table->string("handicap")->nullable();
            $table->string("phone")->nullable();
            $table->string("home_phone")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
