<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailsubscribers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agency_id')->nullable();
            $table->bigInteger('client_id')->nullable();
            $table->string('email');
            $table->longText('info')->nullable();
            $table->integer('valid_email')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('mailsubscribers');
    }
}
