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
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->string('paid_leave');
            $table->string('vacation');
            // $table->foreignId('contract_id')
            //     ->after('id')
            //     ->constrained('contracts')
            //     ->nullable()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            // $table->foreignId('salary_id')
            //     ->after('contract_id')
            //     ->constrained('salaries')
            //     ->nullable()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            // $table->foreignId('education_id')
            //     ->after('salary_id')
            //     ->constrained('education')
            //     ->nullable()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            // $table->foreignId('role_id')
            //     ->after('education_id')
            //     ->constrained('roles')
            //     ->nullable()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            // $table->foreignId('position_id')
            //     ->after('role_id')
            //     ->constrained('positions')
            //     ->nullable()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
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
        Schema::dropIfExists('ranks');
    }
};
