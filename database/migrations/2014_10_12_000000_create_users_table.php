<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable($value = true);
            $table->tinyInteger('gender')->default(0)->comment('0=>giới tính khác,1=>Nam,2=>Nữ');
            $table->uuid('group_user_id')->nullable($value = true);
            $table->string('level')->nullable($value = true);
            $table->string('phone_number', 11);
            $table->tinyInteger('is_sadmin')->nullable($value = true);
            $table->tinyInteger('is_active')->nullable($value = true);
            $table->tinyInteger('is_online')->nullable($value = true);
            $table->softDeletes();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
