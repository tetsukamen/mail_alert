<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('date_or_type');
            $table->boolean('week_mon');
            $table->boolean('week_tue');
            $table->boolean('week_wed');
            $table->boolean('week_thu');
            $table->boolean('week_fri');
            $table->boolean('week_sat');
            $table->boolean('week_sun');
            $table->time('time');
            $table->integer('email_amount');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->time('first_alert_timing');
            $table->boolean('second_alert_flag');
            $table->time('second_alert_timing')->nullable();
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
        Schema::dropIfExists('alerts');
    }
}
