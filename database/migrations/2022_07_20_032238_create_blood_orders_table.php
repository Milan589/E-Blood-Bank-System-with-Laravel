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
        Schema::create('blood_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('b_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('order_date');
            $table->date('receive_date');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('b_id')->references('id')->on('blood_banks');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_orders');
    }
};
