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
        Schema::create('order_blood_pouch_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bp_id')->nullable();
            $table->unsignedBigInteger('bo_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('bp_id')->references('id')->on('blood_pouches');
            $table->foreign('bo_id')->references('id')->on('blood_orders');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_blood_pouch_details');
    }
};
