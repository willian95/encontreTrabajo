<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSimplePostToServiceAmounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_amounts', function (Blueprint $table) {
            $table->integer("simple_post_amount")->default(0);
            $table->integer("highlighted_post_amount")->default(0);
            $table->integer("download_profiles_amount")->default(0);
            $table->date("due_date")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_amounts', function (Blueprint $table) {
            //
        });
    }
}
