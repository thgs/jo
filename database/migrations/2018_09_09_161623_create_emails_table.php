<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('uid')->nullable();
            $table->string('from');
            $table->string('cc');
            $table->string('bcc');
            $table->string('to');
            $table->string('reply_to');
            $table->string('subject');
            $table->string('body');
            $table->string('flags');
            $table->string('priority');

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
        Schema::dropIfExists('emails');
    }
}
