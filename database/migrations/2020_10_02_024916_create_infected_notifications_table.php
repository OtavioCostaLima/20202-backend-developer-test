<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfectedNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infected_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('infected_id');
            $table->unsignedBigInteger('notifier_id');
            $table->foreign('infected_id')->references('id')->on('survivors');
            $table->foreign('notifier_id')->references('id')->on('survivors');
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
        Schema::dropIfExists('infected_notifications');
    }
}
