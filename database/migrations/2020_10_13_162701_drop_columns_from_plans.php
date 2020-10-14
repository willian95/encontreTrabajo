<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsFromPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            if(Schema::hasColumn("plans", "post_amount"))
                $table->dropColumn("post_amount");
            
            if(Schema::hasColumn("plans", "conference_amount"))
                $table->dropColumn("conference_amount");
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
