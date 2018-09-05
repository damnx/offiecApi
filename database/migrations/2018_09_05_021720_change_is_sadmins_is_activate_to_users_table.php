<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIsSadminsIsActivateToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE `users` MODIFY `is_sadmin` TINYINT(1) DEFAULT 0;');
            DB::statement('ALTER TABLE `users` MODIFY `is_active` TINYINT(1) DEFAULT 0;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE `users` MODIFY `is_sadmin` TINYINT(1) NULL;');
            DB::statement('ALTER TABLE `users` MODIFY `is_active` TINYINT(1) NULL;');
        });
    }
}
