<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserIdToUsersOauthAuthCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oauth_auth_codes', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE `oauth_auth_codes` MODIFY `user_id` CHAR(36) NOT NULL;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oauth_auth_codes', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE `oauth_auth_codes` MODIFY `user_id` INT(11) NOT NULL;');
        });
    }
}
