<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('order_id');
            $table->tinyInteger('checked_in')->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->decimal('amount', 13, 2);
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            // $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendees');
    }
}
