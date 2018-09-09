<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_accounts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('user_id');

            // Email
            $table->string('username');
            $table->string('password');
            $table->string('host');
            $table->string('port');
            $table->string('encryption');
            $table->string('protocol');

            // Settings
            $table->integer('sync_every')->default(15);

            // Drivers
            $table->string('inbound_repository');

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
        Schema::dropIfExists('email_accounts');
    }
}
