<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobCalendarGroupUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_calendar_group_user', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('job_calendar_id')->comment('id job calendar');
            $table->uuid('group_user_id')->comment('id group user');
            $table->float('coefficient', 2, 1)->comment('hệ số lương');
            $table->time('start');
            $table->time('end');
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
        Schema::dropIfExists('job_calendar_group_user');
    }
}
