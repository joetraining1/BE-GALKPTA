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
        Schema::table('overtimes', function (Blueprint $table) {
            $table->string('duration');
            $table->foreignId('initiator_id')
                ->after('id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('todo_id')
                ->nullable()
                ->after('initiator_id')
                ->constrained('todos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::table('rosters', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->after('id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('ovt_id')
                ->after('user_id')
                ->constrained('overtimes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('overtimes', function (Blueprint $table) {
            $table->dropColumn('initiator_id');
            $table->dropColumn('todo_id');
        });

        Schema::table('rosters', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('ovt_id');
        });
    }
};
