<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobCalendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_calenda', function (Blueprint $table) {
            $table
                ->increments('id');
            $table
                ->tinyInteger('day')
                ->comment(
                    '0=>Sunday',
                    '1=>Monday',
                    '2=>Tuesday',
                    '3=>Wednesday',
                    '4=>Thursday',
                    '5=>Friday',
                    '6=>Saturday'
                );
            $table
                ->float('coefficient', 1, 1)
                ->comment('hệ số tính lương');
            $table
                ->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_calenda');
    }
}
