<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("college");
            $table->string("educational_level");
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->string("state");
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
        Schema::dropIfExists('academic_backgrounds');
    }
}
