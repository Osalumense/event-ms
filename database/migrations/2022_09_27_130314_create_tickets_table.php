<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('user_id');
            $table->bigInteger('event_id');
            // $table->unsignedInteger('order_id')->nullable();
            $table->decimal('price', 13, 2);
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->integer('quantity_available')->nullable()->default(null);
            $table->integer('quantity_sold')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('reserved_tickets', function ($table) {
            $table->bigIncrements('id');
            $table->integer('ticket_id');
            $table->integer('event_id');
            $table->integer('quantity_reserved');
            $table->datetime('expires');
            $table->string('session_id', 45);
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
        $tables = [
            'tickets',
            'reserved_tickets',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach($tables as $table) {
            Schema::drop($table);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
