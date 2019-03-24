<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_session', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')
                ->references('id')->on('sessions');

            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')
                ->references('id')->on('packages');
            $table->unsignedBigInteger('session_amount');
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
        Schema::dropIfExists('session_package_');
    }
}
