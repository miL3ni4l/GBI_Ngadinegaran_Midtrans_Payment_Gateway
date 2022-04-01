<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSignInAtToUsers extends Migration
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
            $table -> timestamp('last_sign_in_at')->nullable();
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
            $table -> dropColumn('last_sign_in_at');
        });
    }
}
