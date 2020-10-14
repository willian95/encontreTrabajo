<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->integer("simple_posts")->nullable();
            $table->integer("hightlight_posts")->nullable();
            $table->boolean("offer_posting")->default(true);
            $table->integer("post_days");
            $table->string("plan_time");
            $table->boolean("download_curriculum")->default(true);
            $table->boolean("show_video")->default(true);
            $table->integer("download_profiles")->nullable();
            $table->integer("position")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            //
        });
    }
}
