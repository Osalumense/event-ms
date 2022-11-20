<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('accounts', function ($table) {
            $table->increments('id');
    
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->unsignedInteger('currency_id')->nullable();
            $table->string('last_ip')->nullable();
            $table->timestamp('last_login_date')->nullable();
    
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->unsignedInteger('country_id')->nullable();
    
            $table->boolean('is_active')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('account_id');
            $table->string('first_name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->enum('gender', ['10', '20', '30'])->nullable();
            $table->string('email')->unique();
            $table->string('mobile_number', 15)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type', [10, 20]);
            $table->enum('is_active', [0, 1])->default(1);
            $table->rememberToken();
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
        // Schema::dropIfExists('users');

        $tables = [
            'accounts',
            'users',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach($tables as $table) {
            Schema::drop($table);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
