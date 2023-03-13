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
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->date('event_date')->nullable();
            $table->string('event_time',10)->nullable();
            $table->string('amount_of_gathering',10)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('venue_or_hall',50)->nullable();
            $table->string('type',10)->nullable();
            $table->json('advance_details')->nullable();
            $table->json('followup_details')->nullable();
            $table->string('event_status',10)->nullable();
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
