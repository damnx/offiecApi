<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdToGroupUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_users', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE `group_users` MODIFY `id` CHAR(36);');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_users', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE `group_users` MODIFY `id` INTEGER AUTO_INCREMENT NOT NULL;');
        });
    }
}
