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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')
            //     ->after('id')
            //     ->constrained('users')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            // $table->foreignId('status_id')
            //     ->after('user_id')
            //     ->constrained('statuses')
            //     ->nullable()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            // $table->foreignId('absence_id')
            //     ->after('status_id')
            //     ->constrained('absences')
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
        Schema::dropIfExists('attendances');
    }
};
