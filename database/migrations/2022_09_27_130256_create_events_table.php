<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('slug');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('description');
            $table->string('bg_image_path')->nullable();
            $table->integer('account_id')->unsigned()->index();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('location_address', 355)->nullable();
            $table->string('location_address_line_1', 355);
            $table->string('location_address_line_2', 355)->nullable();
            $table->string('location_country')->nullable();
            $table->string('location_country_code')->nullable();
            $table->string('location_state');
            $table->string('location_post_code');
            $table->string('location_street_number')->nullable();
            $table->text('post_order_display_message')->nullable();
            $table->tinyInteger('is_active')->default(0);
            // $table->unsignedInteger('currency_id')->nullable();
            // $table->foreign('currency_id')->references('id')->on('currencies');
            $table->softDeletes();
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
        Schema::dropIfExists('events');
    }
}
