<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferViewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_viewers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("offer_id");
            $table->timestamps();

            $table->foreign("offer_id")->references("id")->on("offers");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_viewers');
    }
}
