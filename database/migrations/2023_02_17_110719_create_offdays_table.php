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
        Schema::create('offdays', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')
            // ->after('id')
            // ->constrained('users')
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            // $table->foreignId('permitter_id')
            // ->after('user_id')
            // ->nullable()
            // ->constrained('users')
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            // $table->foreignId('absence_id')
            // ->after('permitter_id')
            // ->nullable()
            // ->constrained('absences')
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            // $table->foreignId('status_id')
            // ->after('absence_id')
            // ->nullable()
            // ->constrained('statuses')
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->string('start_date');
            $table->string('comeback');
            $table->string('reason');
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
        Schema::dropIfExists('offdays');
    }
};
