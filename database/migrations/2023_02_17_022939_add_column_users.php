<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->after('name')->nullable();
            $table->string('bank_account')->after('email_verified_at')->nullable();
            $table->string('alamat')->before('password')->nullable();
            $table->string('gender')->after('phone')->nullable();
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
            $table->dropColumn('acronim');
            $table->dropColumn('bank_account');
            $table->dropColumn('alamat');
            $table->dropColumn('gender');
        });
    }
};
