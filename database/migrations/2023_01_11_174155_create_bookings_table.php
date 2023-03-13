<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('booking_no')->nullable();
            $table->integer('venue_id')->nullable();
            $table->integer('package_id')->unsigned();
            $table->json('book_data')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->dateTime('booking_datetime')->nullable();
            $table->enum('status', ['ordered', 'inprogress', 'completed']);
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
        Schema::dropIfExists('bookings');
    }
}