<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrentSignInAtToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Authentication & Events
        Schema::table('users', function (Blueprint $table) {
            $table -> timestamp('current_sign_in_at')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Authentication & Events
        Schema::table('users', function (Blueprint $table) {
            $table -> dropColumn('current_sign_in_at');
        });
    }
}
