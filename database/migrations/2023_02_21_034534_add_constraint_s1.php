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
            $table->foreignId('type_id')
                ->nullable()
                ->after('bank_id')
                ->constrained('types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->after('id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('reviewer_id')
                ->after('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('class_id')
                ->nullable()
                ->after('reviewer_id')
                ->constrained('classifications')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('ondays')->nullable();
            $table->string('offdays')->nullable();
            $table->string('overtimes')->nullable();
            $table->string('summary')->nullable();
            $table->text('review')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropIfExists();
        });
        Schema::table('classifications', function(Blueprint $table){
            $table->dropIfExists();
        });
    }
};
