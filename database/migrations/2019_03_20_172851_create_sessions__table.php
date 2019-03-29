<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('day');
            $table->time('start_at');
            $table->time('finish_at');
            $table->unsignedDecimal('price', 10,2);
            $table->unsignedBigInteger('gym_id');
            $table->unsignedBigInteger('session_amount');
            $table->foreign('gym_id')
                ->references('id')->on('gyms');
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
        Schema::dropIfExists('sessions_');
    }
}
