<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')
                ->references('id')->on('members');

            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')
                ->references('id')->on('sessions');

            $table->unsignedDecimal('init_price', 10, 8);
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
        Schema::dropIfExists('purchases_');
    }
}
