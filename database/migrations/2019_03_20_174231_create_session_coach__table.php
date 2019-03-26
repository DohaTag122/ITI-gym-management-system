<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionCoachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_session', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')
                ->references('id')->on('sessions')->onDelete('cascade');

            $table->unsignedBigInteger('coach_id');
            $table->foreign('coach_id')
                ->references('id')->on('coaches')->onDelete('cascade');
                
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
        Schema::dropIfExists('session_coach');
    }
}
