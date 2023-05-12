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
        Schema::table('ranks', function (Blueprint $table) {
            $table->foreignId('contract_id')
                ->nullable()
                ->after('id')
                ->constrained('contracts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('salary_id')
                ->nullable()
                ->after('contract_id')
                ->constrained('salaries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('education_id')
                ->nullable()
                ->after('salary_id')
                ->constrained('education')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('role_id')
                ->nullable()
                ->after('education_id')
                ->constrained('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('position_id')
                ->nullable()
                ->after('role_id')
                ->constrained('positions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->after('id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('status_id')
                ->nullable()
                ->after('user_id')
                ->constrained('statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('offdays', function (Blueprint $table) {
            $table->foreignId('user_id')
            ->after('id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('permitter_id')
            ->nullable()
            ->after('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('absence_id')
            ->nullable()
            ->after('permitter_id')
            ->constrained('absences')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('annual_id')
            ->nullable()
            ->after('absence_id')
            ->constrained('annuals')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('status_id')
            ->nullable()
            ->after('annual_id')
            ->constrained('statuses')
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
        Schema::table('ranks', function (Blueprint $table) {
            $table->dropIfExists();
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIfExists();
        });

        Schema::table('offdays', function (Blueprint $table) {
            $table->dropIfExists();
        });
    }
};
