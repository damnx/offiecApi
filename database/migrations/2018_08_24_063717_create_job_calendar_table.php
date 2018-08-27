<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_calendar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date',10);
            $table->tinyInteger('day')->comment(
                '0=>Sunday',
                '1=>Monday',
                '2=>Tuesday',
                '3=>Wednesday',
                '4=>Thursday',
                '5=>Friday',
                '6=>Saturday');
            $table->text('description')->nullable($value = true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_calendar');
    }
}
