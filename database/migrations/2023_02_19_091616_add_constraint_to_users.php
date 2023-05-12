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
            $table->foreignId('department_id')
            ->after('id')
            ->nullable()
            ->constrained('departments')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('rank_id')
            ->after('department_id')
            ->nullable()
            ->constrained('ranks')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('deployment_id')
            ->after('rank_id')
            ->nullable()
            ->constrained('deployments')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('bank_id')
            ->after('deployment_id')
            ->nullable()
            ->constrained('banks')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropIfExists();
        });
    }
};
