<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('creator_id');
            $table->uuid('user_id');
            $table->string('name');
            $table->string('link')->nullable($value = true);
            $table->tinyInteger('status');
            $table->integer('time_comitted')->comment('phút');
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->integer('finish')->comment('phút');
            $table->integer('false')->comment('phút');
            $table->longText('description')->nullable($value = true);
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
        Schema::dropIfExists('tasks');
    }
}
